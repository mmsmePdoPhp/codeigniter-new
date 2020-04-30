const axios = require('./../../node_modules/axios/dist/axios');

//  codes for manage and manupulate group pages entity
new Vue({
	el: '#app',
	data: {
		//start scope => usertype
		//desc => get usertype with type atglance
		msg: 'hi from mssg',
		a: 1, 
		tag: 'atglance',
		userTypes:null,
		columns:null,
		//end scope => usertype
		rowCounts:0,
		currentRow :0,

		isResponsiveTable:false

	},
	methods: {
		//start scope => usertype
		//desc => get usertype with type atglance
		async showUserType(e,tag=null,page=0) 
		{
			let that = this;
			that.currentRow =0;
			that.isResponsiveTable=false;
			that.userTypes=null;

			if(tag==null){
				e.preventDefault();
				if(e.target.innerText != that.tag){
					that.tag= e.target.innerText;
				}
				//default pages option
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
			//add tag to url
			if(tag==null){
				url = 'http://localhost/ciblog/users/ajaxindex/'+e.target.innerText
			}else{
				url = 'http://localhost/ciblog/users/ajaxindex/'+tag
			}
			//then add page for paginations
			url += '/' + page

			await axios.get(url)
				.then(function (response) {
					//if operation code was set add field edit for all user
					that.userTypes= response.data;
					
						that.rowCounts=(Math.ceil(response.data.count/10));

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
			
		},
		//end scope => usertype


		// functionality for pagination with vuejs
		async paginatePage(e,tag=null){
			e.preventDefault()
			let that = this;

			
				//clearn data
				that.userTypes=null;
				let listclass=Array.from(e.srcElement.parentElement.parentElement.children).forEach(item => {
					item.children[0].classList.remove('bg-teal')
					item.children[0].classList.remove('hvr-wobble-vertical')
				});
				
				e.toElement.classList.add('bg-teal')
				e.toElement.classList.add('hvr-wobble-vertical')

				
			let page;
			if(tag==null){
				page =  parseInt(e.target.innerText);
				that.currentRow =parseInt(page);

			}else if(tag=='prev'){
				page = parseInt(that.currentRow)-1;
			}else if(tag == 'next'){
				page = parseInt(that.currentRow)+1;

			}else{

			}

			that.currentRow=page;

			// Make a request for a user with a given ID
			let url;
			//add tag to url
			url = 'http://localhost/ciblog/users/ajaxindex/'+that.tag
			//then add page for paginations
			url += '/' + page*10

			await axios.get(url)
				.then(function (response) {
					//if operation code was set add field edit for all user
					that.rowCounts=(Math.ceil(((response.data.count)/10)));
					response.data.pop();
					that.userTypes= response.data;
					

					if(that.tag=='operation'){
						that.userTypes.map(item => {
							item.edit = 'edit'
						})
					}else if(that.tag=='fullinfo'){
						that.isResponsiveTable=true;
					}else{

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
