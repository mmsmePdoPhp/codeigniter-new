const axios = require('./../../node_modules/axios/dist/axios');

//  codes for manage and manupulate group pages entity
new Vue({
	el: '#app',
	data: {
		//start scope => usertype
		//desc => get usertype with type atglance
		msg: 'hi from mssg',
		a: 1, 
		userTypes:null,
		columns:null,
		//end scope => usertype

		isResponsiveTable:false

	},
	methods: {
		//start scope => usertype
		//desc => get usertype with type atglance
		async showUserType(e,tag=null) 
		{
			let that = this;
			that.isResponsiveTable=false;
			if(tag==null){
				e.preventDefault();
				//clearn data
				that.userTypes=null;
				let listclass=Array.from(e.srcElement.parentElement.parentElement.children).forEach(item => {
					item.children[0].classList.remove('bg-teal')
					item.children[0].classList.remove('hvr-wobble-vertical')
				});
				
				e.toElement.classList.add('bg-teal')
				e.toElement.classList.add('hvr-wobble-vertical')
			}

			// Make a request for a user with a given ID
			let url;
			if(tag==null){
				url = 'http://localhost/ciblog/users/ajaxindex/'+e.target.innerText
			}else{
				url = 'http://localhost/ciblog/users/ajaxindex/'+tag
			}
			await axios.get(url)
				.then(function (response) {
					//if operation code was set add field edit for all user
					that.userTypes= response.data;
					console.log(response.data)
					if(tag==null){
						if(e.target.innerText=='operation'){
							that.userTypes.map(item => {
								item.edit = 'edit'
							})
						}else if(e.target.innerText=='fullinfo'){
							that.isResponsiveTable=true;
						}else{

						}
					}
					
					//get all column value
					that.columns = Object.keys(that.userTypes[0])

				})
				.catch(function (error) {
					// handle error
					console.log(error);
				})
				.finally(function () {
					// always executed
				});

		},
		hoverUsertypeFilter(e){
			let that = this;
			e.preventDefault();
			let listclass=Array.from(e.srcElement.parentElement.parentElement.children).forEach(item => {
				item.children[0].classList.remove('btn-info')
			});
			
			e.toElement.classList.add('btn-info')
		},
		leftUsertypeFilter(e){
			let that = this;
			e.preventDefault();
			let listclass=Array.from(e.srcElement.parentElement.parentElement.children).forEach(item => {
				item.children[0].classList.remove('btn-info')
			});
			
		}
		//end scope => usertype

	},
	computed: {
		
	},
	mounted: function () {
		//start scope => usertype
		//desc => get usertype with type atglance
		this.showUserType(null,this.$refs.atglance.innerText);
		this.$refs.atglance.classList.add('bg-teal')
		//end scope => usertype
		
	}
})
