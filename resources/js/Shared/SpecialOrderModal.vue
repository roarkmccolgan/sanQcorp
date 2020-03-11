<template>
	<div class="fixed inset-0 flex items-center justify-center bg-trans-gray z-20" v-show="show">
		<div class="rounded shadow bg-white w-full mx-1 sm:w-1/3">
			<div class="rounded-t bg-gray-800 px-4 py-4 text-white font-thin text-lg">
				Special Order {{ job.name }}
			</div>
			<div class="p-4">
				<div class="mb-2">
					<div class="my-1">
						<label class="block mr-4 text-gray-700 text-sm mb-1">Name</label>
						<auto-complete v-model="selected" @input="selectProduct" :options="options" :search="searchText" @search="newSearchText => searchText = newSearchText"/>
						<p class="text-red-500 text-xs italic mt-1" v-if="errors.name">Required</p>
					</div>
				</div>
				<div class="mb-2 flex">
					<div class="flex-1 mr-2">
						<label class="block mr-4 text-gray-700 text-sm mb-1">Quantity Required</label>
						<input class="w-32 appearance-none border rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" :class="{'border-red-500' : errors.qty}" type="number" v-model="product.qty" placeholder="">
						<p class="text-red-500 text-xs italic mt-1" v-if="errors.qty">Required</p>
					</div>
					<div class="flex-1 mr-2" v-if="catType == 'reticulation'">
						<label class="block mr-4 text-gray-700 text-sm mb-1"># Feeds</label>
						<input class="w-32 appearance-none border rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" :class="{'border-red-500' : errors.feeds}" type="number" v-model="product.feeds" placeholder="">
						<p class="text-red-500 text-xs italic mt-1" v-if="errors.feeds">Required</p>
					</div>
				</div>
				<div class="mb-2">
					<div class="my-1">
						<label class="block mr-4 text-gray-700 text-sm mb-1">Reason for special order</label>
						<textarea class="w-full appearance-none border rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" :class="{'border-red-500' : errors.comment}"  v-model="product.comment" placeholder="" rows="4"></textarea>
						<p class="text-red-500 text-xs italic mt-1" v-if="errors.comment">Required</p>
					</div>
				</div>
				<div class="">
					<div class="my-1">
						<label class="inline-block mr-4 text-gray-700 text-sm mb-1">Category:</label>
						<span class="text-sm">{{ categoryName }}</span>
					</div>
				</div>
			</div>
			<div class="rounded-b bg-gray-200 px-4 py-2">
				<div class="flex items-center justify-between">
					<action-button class="link" @button-clicked="cancel">cancel</action-button>
					<action-button class="btn btn-blue" @button-clicked="save">Send</action-button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import AutoComplete from './AutoComplete.vue'

export default {
	props: ['job', 'show', 'accountId', 'specialOrder'],
	data () {
		return {
			errors: {
				product_id: false,
				qty: false,
				comment: false,
			},
			product: {
				phase_id: this.specialOrder.phase,
				area_id: this.specialOrder.area,
				block_id: this.specialOrder.block,
				unit_id: this.specialOrder.unit,
				job_id: this.specialOrder.job,
				product_id: '',
				qty: '',
				feeds: 1,
				comment: '',
				type: '',
				placed_by: ''
			},
			products: [],
			selected: null,
      		searchText: '',
		}
	},
	methods: {
		checkForErrors () {
			var keys = Object.keys(this.errors)
			for (var i = keys.length - 1; i >= 0; i--) {
				if (String(this.product[keys[i]]).trim() === '') {
					this.errors[keys[i]] = true
				} else {
					keys.splice(i, 1)
				}
			}
			return keys.length
		},
		selectProduct (product) {
			this.product.product_id = product.id;
		},
		cancel () {
			this.$emit('close')
		},
		save () {
			if (this.checkForErrors()) return;
			// console.log(this.product);
			// return;
			// console.log('here');
			this.$http.post(`jobs/${this.job.id}/specialorders/`, this.product)
				.then(response => {
					let success = {
						title: 'Action Successful',
						message: 'Order Placed Successfully!',
						type: 'success'
					}
					this.$store.commit('setStatus', success)	
					this.$emit('reload')
					this.$emit('close')
				})
				.catch(err => {
					this.error = err
				})
		}
	},
	computed: {
		categoryName: function () {
			return this.$store.getters.getProductCategoryNameById(this.specialOrder.catId)
		},
		options() {
			return this.products.filter(product =>
				product.name.toLowerCase().startsWith(this.searchText.toLowerCase())
			)
			.map(product =>
				({
					id: product.id,
					name: product.name
				})
			);
		},
		catType: function(){
			return this.$store.getters.getProductCategoryKeyByIndex(this.specialOrder.catId)
		}
	},
	components: {
		AutoComplete
	},
	watch: {
		show: {
			immediate: true,
			handler: show => {
				if (show) {
					document.body.style.setProperty('overflow', 'hidden')
				} else {
					document.body.style.removeProperty('overflow')
				}
			}
		}
	},
	created () {
		this.product.type = this.$store.getters.getProductCategoryKeyByIndex(this.specialOrder.catId);
		this.product.placed_by = this.$store.getters['auth/userid'];

		const listener = document.addEventListener('keydown', e => {
			if (this.show && e.keyCode === 27) {
				this.cancel()
			}
		})

		this.$once('hook:beforeDestroy', () => {
			document.removeEventListener('keydown', listener)
			document.body.style.removeProperty('overflow')
		});

		this.$http.post('productsbycategory',{
			'category_id': this.specialOrder.catId
		}).then((response) => {
			this.products = response.data.products;
		})
	}
}
</script>
