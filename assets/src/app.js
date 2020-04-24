// import all require packages

const axios = require('./../node_modules/axios/dist/axios');


//  my codes
new Vue({
	el: '#app',
	data: {
		msg: 'hi from mssg',
		a: 1
	},
	methods: {
		showUserType(e) {
			e.preventDefault();
			// Make a request for a user with a given ID
			axios.get('http://localhost/ciblog/usertype/ajaxindex/active')
				.then(function (response) {

					// handle success
					console.log(response);
				})
				.catch(function (error) {
					// handle error
					console.log(error);
				})
				.finally(function () {
					// always executed
				});

		}
	},
	created: function () {
		// `this` points to the vm instance
		console.log('a is: ' + this.a)
	}
})


