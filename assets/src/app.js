// import all require packages
require ('./../node_modules/jquery/dist/jquery');
require ('./../node_modules/bootstrap/dist/js/bootstrap');


//  my codes
new Vue({
	el: '#app',
	data: {
	  msg: 'hi from mssg'
	},
	created: function () {
	  // `this` points to the vm instance
	  console.log('a is: ' + this.a)
	}
})

  
