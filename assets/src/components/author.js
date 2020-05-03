const axios = require('axios/dist/axios');

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
		isResponsiveTable:false,
		rowCounts:null,
		//end scope => usertype

	},
	methods: {
		//start scope => usertype
		//desc => get usertype with type atglance
		async showUserType(e,tag=null) {
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
				url = 'http://localhost/ciblog/author/ajaxindex/'+e.target.innerText
			}else{
				url = 'http://localhost/ciblog/author/ajaxindex/'+tag
			}
			await axios.get(url)
				.then(function (response) {
					//if operation code was set add field edit for all user
					that.userTypes= response.data;
					that.getRowCounts(tag)
					delete that.userTypes.count
					console.log(that.userTypes)
					if(tag==null){
						if(e.target.innerText=='operation'){
							that.userTypes.map(item => {
								item.edit = 'edit'
							})

							console.log('op',that.userTypes)
						}else if(e.target.innerText=='fullinfo'){
							that.isResponsiveTable= true;
							
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
			
		},

		async getRowCounts(tag=null){
			// Make a request for a user with a given ID
			let url;
			if(tag==null){
				url = 'http://localhost/ciblog/author/rowCount/'+'atglance'
			}else{
				url = 'http://localhost/ciblog/author/rowCount/'+tag
			}
			await axios.get(url)
				.then(function (response) {
					//if operation code was set add field edit for all user
					console.log('rowcount:',response.data)
					that.rowCounts = response.data;
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
