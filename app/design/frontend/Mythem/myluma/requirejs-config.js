/*var config = {
	deps: ['js/main']
}*/
var config = {
	paths:{
		slick: 'js/slick.min',
		bootstrap: 'Magento_Theme/js/bootstrap.bundle',
	},
	shim:{
		slick:{
			desp: ['jquery']
		},
		bootstrap: {
			'deps': ['jquery']
		}
	},
	deps: ['js/main']
}