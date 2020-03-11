<template>
	<div class="zoom" ref="theHtml">
		<div class="proposal">
			<div id="cover" style="position: relative;">
				<div id="header" style="width: 210mm; height: 40mm; margin: 14.219mm 20mm 10mm 10mm;">
					<img id="logo" :src="`${appUrl}/img/proposal/logo.jpg`" alt="" style="width: 77mm; height: 27.9mm; display: inline-block; vertical-align: top">
					<div style="width: 73mm; display: inline-block; padding-top: 6mm; text-align: right; font: 10pt/14pt 'Times New Roman, Times, serif';">
						SANIKA cc<br/>
						P.O. BOX 303<br/>
						BENONI<br/>
						1500
					</div>
					<div style="width: 50mm; display: inline-block; padding-top: 6mm; text-align: right; font: 10pt/14pt 'Times New Roman, Times, serif';">
						TEL. 011 425 3061<br/>
						FAX. 011 425 6383<br/>
						REG. 1992/009387/23<br/>
						EMAIL. admin@sanika.co.za
					</div>
				</div>
				<div id="title" style="width: 190mm; margin: 0mm 20mm; margin-bottom: 20mm">
					<h1>Quotation Proposal</h1>
					<h2 class="title">
						{{proposaltitle}}
					</h2>
				</div>
				<div id="info" style="width: 210mm; height: 105mm; margin: 0mm 20mm;">
					<table cellspacing="0" cellpadding="2" style="margin-bottom: 10mm; width: 190mm">
						<tr>
							<td style="text-align: right; width: 30%">Sanika Reference: <strong>{{form.job.order_number}}</strong></td>
							<td style="text-align: right">Date: <strong>{{ form.job.created_at }}</strong></td>
						</tr>
					</table>
					<table cellspacing="0" cellpadding="10" style="margin-bottom: 20mm; width: 190mm; vertical-align: top">
						<tr>
							<td style="vertical-align: top; width: 30%; text-align: right;">Prepared for:</td>
							<td style="padding-left: 10pt; padding-bottom: 10pt">
								<template v-for="contact in form.job.contacts">
									<strong>{{contact.first_name}} {{contact.last_name}}</strong><br/>
									Email: <a :href="`mailto:${contact.email}`">{{contact.email}}</a><br/>
								</template>
							</td>
						</tr>
						<tr>
							<td style="vertical-align: top;width: 30%; text-align: right">Address:</td>
							<td style="padding-left: 10pt; padding-bottom: 10pt">
								{{form.job.address}}<br/>
								{{form.job.suburb}}<br/>
								{{form.job.city}}<br/>
								{{form.job.country}}
							</td>
						</tr>
						<tr v-if="form.user">
							<td style="vertical-align: top;width: 30%; text-align: right">Prepared by:</td>
							<td style="padding-left: 10pt; padding-bottom: 10pt">
								{{ form.user.name }}<br/>
								<a :href="`mailto:${form.user.email}`" target="_blank">{{ form.user.email }}</a><br/>
								Sanika Waterproofing
							</td>
						</tr>
					</table>
				</div>
				<img :src="`${appUrl}/img/proposal/2540years.jpg`" alt="">
			</div>
			<div class="proposal-section">
				<p>Dear {{form.job.contacts[0].first_name}}</p>
				<p>We thank you for affording us the opportunity to quote you on the above work, Our proposal is as follows:</p>
				<h2 class="profile">Company Profile</h2>
				<p>
					Sanika waterproofing has been firmly entrenched in the specialist waterproofing, industrial coating and roofing industry since 1987.
				</p>
				<p>
					Sanika Waterproofing, a level 3 BEE compliant provider, and are the exclusive approved distributors and applicators of Kryton Crystalline Waterproofing Products for Southern Africa. The Kryton systems are applied by internationally accredited staff and teams and the application methods adhere to the stringent worldwide Kryton standards. To date, Sanika are the successful applicators of the World's longest crack repair using the Kryton product range.
				</p>
				<p>
					Our Profile has been extensive within the Commercial, Industrial and Mining spheres and we pride ourselves in preparing long term cost effective high quality concrete rejuvenation and waterproofing solutions, painting and waterproofing coating systems nationwide.
				</p>
				<p>
					All our systems and application methods are designed to offer maximum protection over the longest period of time whilst maintaining cost effectiveness and guaranteed client satisfaction.
				</p>
				<p>
					Our company is structured to offer prompt and professional service at all times to ensure uninterrupted service to your facility. Our professional staff compliment has all undergone extensive training on the application of the products and services we offer and they too pride themselves on exceptional service and quality standards.
				</p>
				<p>
					Our registered systems and application methods have already been proven and approved by senior engineering management at:
				</p>
				<table cellpadding="10pt" style="font-weight: bold;">
					<tr>
						<td>
							Impala Platinum<br/>
							Investec Property Services<br/>
							Mnet (NMSCOM / Multichoice)<br/>
							Impala Platinum Minpro<br/>
							The South African Breweries
						</td>
						<td>
							Anglo American<br/>
							Growthpoint Properties<br/>
							Broll Properties<br/>
							Liberty Properties<br/>
							Rand Refineries
						</td>
						<td>
							Tiger Brands<br/>
							Johnson Matthey<br/>
							JHI<br/>
							Sanlam
						</td>
					</tr>
				</table>

			</div>
			<div class="proposal-section">
				<img data-main :src="getImageBlob(form.mainPhoto.edited, 'main')" @load="revoke" alt="" v-if="form.mainPhoto.edited">
				<template v-if="form.photos.length > 0">
					<strong>Site photos:</strong>
					<div class="flex flex-wrap justify-between">
						<div class="w-1/2" v-for="(image, key) in form.photos">
							<div class="p-2">
								<img :data-photo="key" :src="getImageBlob(image, 'photo')" @load="revoke" alt="" class="sitepic">
							</div>
						</div>						
					</div>
				</template>
			</div>
			<div class="proposal-section" v-if="form.sections">
				<template v-for="section in form.sections">
					<h2>{{section.name}}</h2>
					<template v-if="section.survey">
						<h3>Survey</h3>
						<p v-html="section.survey"></p>
					</template>
					<div class="flex flex-wrap justify-between">
						<div class="w-1/2" v-for="(image, imageKey) in section.photos">
							<div class="p-2">
								<img :data-section="imageKey" :src="getImageBlob(image, 'section')" @load="revoke" alt="" class="sitepic">
							</div>
						</div>						
					</div>
					
					<template v-if="section.options">
						<div v-for="(option, optionKey) in section.options" style="margin-bottom: 30mm; margin-left: 5mm">
							<template v-if="option.system_id">
								<h4 style="margin-bottom: 0;"><span v-if="section.options.length > 1">Option {{optionKey+1}} - </span>{{option.name}}</h4>
								<p v-html="option.description"></p>
								<img v-if="systems[option.system_id].photos.length > 0" :src="`${appUrl}/img/systems/${systems[option.system_id].photos[0].photo}`" alt="" style="width: 170mm;margin: 10mm 0mm;">
								<div v-if="systems[option.system_id].photos.length > 0" class="pb"></div>
								<div>
									<h5>Scope of Work</h5>
									<ul v-if="option.tasks">
										<li class="list-decimal">Establish site and safe working procedures in accordance with  OSH and client requirements</li>
										<li class="list-decimal" v-for="task in option.tasks">{{task.description}}</li>
										<li class="list-decimal">Clean and de-establish site</li>
									</ul>
									<template v-if="systems[option.system_id].guarantee">
										<div class="mb-4" v-if="option.notes.length">
											<h5 class="text-lg font-bold">Please note</h5>
											<div class="mb-1" v-for="note in option.notes" v-html="note.note"></div>
										</div>
										<h5 class="text-lg font-bold">Guarantees</h5>
										<table>
											<tr>
												<td>
													<div class="guarantee">
														<div class="number">{{systems[option.system_id].guarantee.years}}</div>
														<div class="years">years</div>
													</div>
												</td>
												<td style="padding-left: 4mm; padding-top: 2mm" v-html="systems[option.system_id].guarantee.description"></td>
											</tr>
										</table>
									</template>

									<div v-if="option.notes.length > 0">
									</div>
								</div>
							</template>
						</div>
					</template>
				</template>
			</div>
			<div class="proposal-section" v-if="form.sections">
				<h3>Price Structure</h3>
				<small>(Prices exclude V.A.T.)</small><br/>
				<template v-for="section in form.sections">
					<template v-if="section.options">
						<table cellpadding="5mm" style="width: 190mm; margin-bottom: 10mm; border-bottom: 1px solid #EFEFEF">
							<template v-for="(option, optionKey) in section.options">
								<tr>
									<td style="width: 70%"><h6><span v-if="section.options.length > 1">Option {{optionKey+1}} - </span>{{option.name}}</h6></td>
									<td style="width: 30%">
										<h4 style="text-decoration: none;">{{option.total_cost_price+((option.total_cost_price/100)*option.markup) | toCurrency}}</h4>
									</td>
								</tr>
								<template v-if="pandgTotal">
									<tr v-if="pandgTotal">
										<td>
											P's and G's
										</td>
										<td>{{pandgTotal | toCurrency }}</td>
									</tr>
									<tr>
										<td><h5 class="text-right" style="margin-right: 5mm">Total</h5></td>
										<td><h5>{{option.total_cost_price+((option.total_cost_price/100)*option.markup)+pandgTotal | toCurrency }}</h5></td>
									</tr>
								</template>
							</template>
						</table>
					</template>
				</template>
				<template v-if="form.jobpsandgs.length > 0">
					<strong>P's &amp; G's:</strong><br/>
					The above quotation includes the following P's &amp; G's
					<ul>
						<li v-for="pandg in form.jobpsandgs">@{{pandg.name}}</li>
					</ul>
					<table cellpadding="5mm" style="width: 190mm">
						<tr>
							<td style="width: 70%"><h6>Total for all P's &amp; G's</h6></td>
							<td style="width: 30%"><h6>@{{pandgTotal | currency 'R'}}</h6></td>
						</tr>
					</table>
				</template>
				<div class="flex flex-wrap w-full">
					<div class="w-1/2 border bg-gray-200">
						<div class="p-2">
							<h6>The above price structures INCLUDES:</h6>
							<ul>
								<li v-for="(include, includeKey) in form.jobincludes">{{include.item}}</li>
							</ul>							
						</div>
					</div>
					<div class="w-1/2 border bg-gray-200">
						<div class="p-2">
							<h6>The above price structure EXCLUDES:</h6>
							<ul>
								<li v-for="(exclude, excludeKey) in form.jobexcludes">{{exclude.item}}</li>
							</ul>							
						</div>
					</div>					
				</div>
			</div>
		</div>
		
	</div>
</template>

<script>

	export default {

		name: 'Proposal',

		props: {
			form: Object,
			systems: Object
		},

		data () {
			return {
			}
		},
		computed: {
			appUrl: function(){
				return process.env.MIX_APP_URL;
			},
			proposaltitle: function(){
				if(this.form.title){
					return this.form.title;
				}else{
					var list = [];
					this.form.sections.forEach((sec, i) => list.push(sec.name))
					return (this.form.title1 || '') + ' ' + list.join(", ") + ' ' + (this.form.title2 || '');
				}
			},
			pandgTotal: function(){
				let tot = 0;
				this.form.jobpsandgs.forEach(p => tot += p.qty * p.rate);
				return tot;
			},
		},
		watch: {
			// 'form.mainImg': async function (url, old) {
			// 	console.log(url, old);
			// 	let blob = await fetch(url).then(r => r.blob());
			// 	console.log(blob);
			// 	URL.revokeObjectURL(old)
			// },
		},
		methods: {
			revoke: function(event){
				URL.revokeObjectURL(event.target.getAttribute('src'))
			},
			getImageBlob: function(theImage, where){
				console.log(where);
				return URL.createObjectURL(theImage)
			}
		}
	}
</script>

<style lang="css" scoped>
.zoom{
	/*transform: scale(0.8);*/
}
.proposal{
	@apply .font-serif .text-black .bg-white .m-0 .p-0;
}

.proposal h1{
	@apply .text-center .font-bold .text-5xl .leading-none .m-4;
}
.proposal h2{
	@apply .underline .text-3xl .leading-tight;
}
.proposal h2.title{
	@apply .text-center .no-underline
}
.proposal h3{
	@apply text-2xl;
}
.proposal-section h4{
	@apply .text-2xl .font-bold;
}
.proposal-section h5{
	@apply .text-lg .mb-2;
}
.proposal-section h6{
	@apply .font-bold .mb-2;
}
.proposal-section {
	@apply .relative;
	page-break-before: always;
}
.pb{
	page-break-before: always;
}
#proposal .proposal-section h2.profile{
	@apply .text-center .no-underline .font-bold;
	margin-top: 20mm;
}

.proposal-section p {
}
.proposal-section ul li {
	@apply .mb-2;
}
.sitepic{
	@apply .m-1 .border .inline-block;
}

.guarantee{
	@apply .text-center .rounded-full .border-4 .border-gray-400;
	width: 17mm;
	height: 17mm;
}
.guarantee .number{
	@apply .uppercase .block .text-red-600 .font-bold .text-3xl .leading-none .mt-1;
}
.guarantee .years{
	@apply .uppercase .block .text-gray-600 .text-xs .leading-none;
}

</style>