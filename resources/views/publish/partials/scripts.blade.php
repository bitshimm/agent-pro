<script type="text/javascript" src="{{ $host }}/js/lazysizes/lazysizes.min.js"></script>

<script src="{{ $host }}/js/fancybox/fancybox.min.js"></script>

<script src="{{ $host }}/js/swiper/swiper-10.1.0.min.js"></script>

<script src="{{ $host }}/publish_static/script.js?{{ config('version.hash') }}"></script>
<script>
	const images = document.querySelectorAll('img');
	images.forEach(img => {
		let host = {!! json_encode($host) !!}
		let src =  img.getAttribute('src');
		img.setAttribute('src', host + src);
	});
	const imagesLinks = document.querySelectorAll('.images .image');
	imagesLinks.forEach(imageLink => {
		let host = {!! json_encode($host) !!}
		let dataSrc =  imageLink.getAttribute('data-src');
		imageLink.setAttribute('data-src', host + dataSrc);
	});
</script>