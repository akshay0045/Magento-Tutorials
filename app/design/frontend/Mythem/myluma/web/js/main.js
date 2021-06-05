console.log('js integration successfully');
require(['jquery', 'slick'], function($){
	$(function(){
		 $('.main > .myproductGallery > .grid > .product-items').slick({
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  dots: true,
		  autoplay: true,
		  autoplaySpeed: 300
		});
	});
});