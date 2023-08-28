<script setup>
import Editor from '@tinymce/tinymce-vue';
import { ref } from 'vue';

const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
	const xhr = new XMLHttpRequest();
	xhr.withCredentials = false;
	xhr.open('POST', route('tinymce.upload'));
	const token = document.head.querySelector("[name=csrf-token]").content;
	xhr.setRequestHeader("X-CSRF-Token", token);
	xhr.upload.onprogress = (e) => {
		progress(e.loaded / e.total * 100);
	};

	xhr.onload = () => {

		if (xhr.status === 403) {
			reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
			return;
		} else if (xhr.status < 200 || xhr.status >= 300) {
			reject('HTTP Error: ' + xhr.status);
			return;
		}

		const json = JSON.parse(xhr.responseText);

		if (!json || typeof json.location != 'string') {
			reject('Invalid JSON: ' + xhr.responseText);
			return;
		}
		resolve(json.location);
	};

	xhr.onerror = () => {
		reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
	};

	const formData = new FormData();
	formData.append('image', blobInfo.blob(), blobInfo.filename());

	xhr.send(formData);
});

const config = {
	height: 800,

	plugins: [
		'preview', 'importcss', 'searchreplace', 'autolink', 'directionality', 'code', 'visualblocks',
		'visualchars', 'fullscreen', 'image', 'link', 'media', 'template', 'codesample', 'table',
		'charmap', 'nonbreaking', 'anchor', 'insertdatetime', 'advlist', 'lists',
		'wordcount', 'help', 'charmap', 'quickbars', 'emoticons',
	],
	toolbar1: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks',
	toolbar2: 'alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor backcolor removeformat | charmap emoticons',
	toolbar3: 'insertfile image media link anchor code',
	toolbar4: 'customBtn',
	font_family_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats',
	setup(editor) {
		editor.ui.registry.addButton('customBtn', {
			text: 'custon btn',
			onAction: () => {
				let timestamp = new Date().getTime();
				editor.insertContent(`<p id="callbackform-${timestamp}">[ФОРМА ОБРАТНОЙ СВЯЗИ]</p><p>&nbsp;</p>`);
			},
		});
	},
	language: 'ru',
	content_style: "p[id^='callbackform-'] { border: 1px solid #000; }",
	automatic_uploads: true,
	relative_urls: false,
	images_upload_handler: example_image_upload_handler,
	file_picker_callback(callback, value, meta) {
		let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
		let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight

		tinymce.activeEditor.windowManager.openUrl({
			url: '/filemanager',
			title: 'Файловый менеджер',
			width: x * 0.8,
			height: y * 0.8,
			onMessage: (api, message) => {
				callback(message.content, { text: message.text })
			}
		})
	}
}

const showModal = ref(false);
const modalWrapper = ref(null);
const modal = ref(null);

defineProps({
	modelValue: {
		type: String,
		required: true,
	},
	label: String,
	error: String,
});

function openModal() {
	modalWrapper.value.style.display = 'block';
	setTimeout(() => {
		showModal.value = true;
	}, 1);
	document.body.style.overflow = 'hidden';
}
function closeModal() {
	showModal.value = false;
	document.body.style.overflow = 'auto';
	setTimeout(function () {
		modalWrapper.value.style.display = 'none';
	}, 200);
}
function clickOutsideModal(e) {
	if (!modal.value.contains(e.target)) {
		closeModal();
	}
}
defineEmits(['update:modelValue']);

</script>

<template>
	<span class="form-label">{{ label }}:</span>
	<div class="modal-btn" :class="{ error: error }" @click="openModal">Открыть окно</div>
	<div v-if="error" class="form-error">{{ error }}</div>
	<div class="modal-wrapper" ref="modalWrapper" :class="{ modalOpen: showModal }" @click="clickOutsideModal">
		<div class="modal" ref="modal">
			<div class="modal-header">
				{{ label }}
				<span class="modal-close" @click="closeModal">
					<i class="fa-solid fa-xmark"></i>
				</span>
			</div>
			<div class="modal-body">
				<Editor :init="config" :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)"
					tinymce-script-src="/js/tinymce/tinymce.min.js" />
			</div>
		</div>
	</div>
</template>
<style scoped>
.modal-btn {
	background-color: rgb(226, 232, 240);
	padding: 0.5rem 0.75rem;
	border: 1px solid rgb(226, 232, 240);
	border-radius: 6px;
	cursor: pointer;
	text-align: center;
}

.modal-btn.error {
	border-color: rgb(185, 28, 28);
}

.modal-wrapper {
	position: fixed;
	background-color: rgba(0, 0, 0, 0.2);
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	padding: 50px;
	z-index: 100;
	opacity: 0;
	transition: opacity 0.3s ease;
	display: none;
}

.modal-wrapper.modalOpen {
	opacity: 1;
}

.modal {
	padding: 1rem 1.5rem;
	background-color: #fff;
	border-radius: 10px;
	transform: translateY(-50px);
	transition: transform 0.2s ease;
}

.modal-wrapper.modalOpen .modal {
	transform: translateY(0);
}

.modal-header {
	position: relative;
	font-size: 20px;
	margin-bottom: 0.75rem;
}

.modal-close {
	cursor: pointer;
	position: absolute;
	top: 0;
	right: 0;
}
</style>