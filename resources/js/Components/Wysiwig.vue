<script setup>
import Editor from '@tinymce/tinymce-vue';

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
			text: 'Форма обратной связи',
			onAction: () => {
				let timestamp = new Date().getTime();
				editor.insertContent(`<p id="callbackform-${timestamp}">[ФОРМА ОБРАТНОЙ СВЯЗИ]</p><p>&nbsp;</p>`);
			},
		});
	},
	language: 'ru',
	content_style: "p[id^='callbackform-'] { border: 1px solid #000; background-color: rgb(226, 232, 240); }",
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

defineProps({
	modelValue: {
		type: String,
		required: true,
	},
	label: String,
	error: String,
});

defineEmits(['update:modelValue']);
</script>

<template>
    <div class="flex flex-wrap py-4">
        <div class="w-full lg:w-1/5 pr-4">
            <label v-if="label" :for="id" class="pt-2">{{ label }}:</label>
        </div>
        <div class="w-full lg:w-4/5 lg:max-w-screen-md">
            <Editor :init="config" :model-value="modelValue" @update:modelValue="$emit('update:modelValue', $event)"
					tinymce-script-src="/js/tinymce/tinymce.min.js" />
            <div v-if="error" class="text-red-600">{{ error }}</div>
        </div>
    </div>
</template>