<html>
    <head>
        <style type='text/css' id="propstyle">
            #proposal{
                font-family: 'Times New Roman, Times, serif';
                font-size: 12pt;
                color: black;
            }
            #proposal h1{
                text-align: center;
                font-weight: bold;
                font-size: 31pt;
                line-height: 31pt;
                margin:10pt;
            }
            #proposal h2{
                text-align: center;
                font-weight: normal;
                font-size: 20pt;
                line-height: 22pt;
                margin:0;
            }
            .proposal-section {
                page-break-before: always;
                margin: 0 20mm;
                width: 190mm;
                color: black;
                font-family: 'Times New Roman, Times, serif';
                font-size: 12pt;
                line-height: 12pt;
            }
            #proposal .proposal-section h2.profile{
                margin-top: 20mm;
                font-size: 14pt;
                font-weight: bold;
            }
            .proposal-section h4{
                font-size: 14pt;
                font-weight: bold;
                text-decoration: underline;
            }
            .proposal-section h5{
                font-size: 14pt;
                font-weight: bold;
                margin-bottom: 3mm;
                margin-top: 3mm;
            }
            .proposal-section h6{
                font-size: 12pt;
                font-weight: bold;
                margin-bottom: 2mm;
                margin-top: 2mm;
            }
            .proposal-section p {
                font-size: 12pt;
                line-height: 13pt;
                color: black;
            }
        </style>
    </head>
<body style="border:0; margin: 0;">
    <div id="proposal">
        <div id="cover" style="position: relative;">
            <div id="header" style="width: 210mm; height: 40mm; margin: 14.219mm 20mm 10mm 10mm;">
                <img id="logo" src="http://sanqcorp.app/img/invoice/logo.jpg" alt="" style="width: 77mm; height: 27.9mm; display: inline-block; vertical-align: top">
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
            <div id="title" style="width: 190mm; margin: 0mm 20mm; margin-bottom: 31mm">
                <h1>Quotation Proposal</h1>
                <h2>
                    Waterproofing of
                    <span v-for="section in sections">@{{section.name}},</span>
                    at the below site address.
                </h2>
            </div>
            <div id="info" style="width: 210mm; height: 85mm; margin: 0mm 20mm;">
                <table cellspacing="0" cellpadding="2" style="margin-bottom: 30mm; width: 190mm">
                    <tr>
                        <td style="text-align: right; width: 30%">Sanika Reference: <strong>@{{laravel.job.order_number}}</strong></td>
                        <td style="text-align: right">Date: <strong>@{{ laravel.job.created_at | moment "MMMM Do YYYY" }}</strong></td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="10" style="margin-bottom: 30mm; width: 190mm; vertical-align: top">
                    <tr>
                        <td style="vertical-align: top; width: 30%; text-align: right;">Prepared for:</td>
                        <td style="padding-left: 10pt; padding-bottom: 10pt">
                            <template v-for="contact in laravel.job.contacts">
                                <strong>@{{contact.first_name}} @{{contact.last_name}}</strong><br/>
                                Email: <a href="mailto:@{{contact.email}}">@{{contact.email}}</a>
                            </template>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;width: 30%; text-align: right">Address:</td>
                        <td style="padding-left: 10pt; padding-bottom: 10pt">
                            @{{laravel.job.address}}<br/>
                            @{{laravel.job.suburb}}<br/>
                            @{{laravel.job.city}}<br/>
                            @{{laravel.job.country}}
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;width: 30%; text-align: right">Prepared by:</td>
                        <td style="padding-left: 10pt; padding-bottom: 10pt">
                            Roark McColgan<br/>
                            Sanika Waterproofing
                        </td>
                    </tr>
                </table>
            </div>
            <img src="http://sanqcorp.app/img/invoice/2540years.jpg" alt="" style="width: 210mm; height: 50mm; margin-top: 10mm;">
        </div>
        <div class="proposal-section">
            <p>Dear @{{laravel.job.contacts[0].first_name}}</p>
            <p>We thank you for affording us the opportunity to quote you on the above work, Our proposal is as follows:</p>
            <h2 class="profile">Company Profile</h2>
            <p>
                Sanika waterproofing has been firmly entrenched in the specialist waterproofing, industrial coating and roofing industry since 1987.
            </p>
            <p>
                Sanika Waterproofing, a level 3 BEE compliant provider, are the exclusive approved distributors and applicators of Kryton Crystalline Waterproofing Products for Southern Africa. The Kryton systems are applied by internationally accredited staff and teams and the application methods adhere to the stringent worldwide Kryton standards. To date, Sanika are the successful applicators of the World's longest crack repair using the Kryton product range.
            </p>
            <p>
                During this time, we have been instrumental in developing and manufacturing unique, high quality industrial and mining roofing and waterproofing systems. These include patented and registered roofing systems and specialised cladding and sheeting systems; a custom developed sheet locking system and numerous waterproofing membranes, coatings and compounds. 
            </p>
            <p>
                Our Profile has been extensive within the Commercial, Industrial and Mining spheres and we pride ourselves in preparing long term cost effective high quality concrete rejuvenation and waterproofing solutions, painting and waterproofing coating systems nationwide.
            </p>
            <p>
                Sanika are currently actively involved in roofing and waterproofing consultation, water management and corrosion protection systems and concrete crack repair, rejuvenation and concrete waterproofing in the Commercial and Industrial Industries.
            </p>
            <p>
                All our systems and application methods are designed to offer maximum protection over the longest period of time whilst maintaining cost effectiveness and guaranteed client satisfaction.
            </p>
            <p>
                Our company is structured to offer prompt and professional service at all times to ensure uninterrupted service to your facility. Our professional staff compliment have all undergone extensive training on the application of the products and services we offer and they too pride themselves on exceptional service and quality standards.
            </p>
            <p>
                We have vast experience in the commercial environment as can been seen from our references below.
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
        <div class="proposal-section" v-if="sections">
            <template v-if="images.main">
                <img v-bind:src="images.main" alt="" style="margin: 10mm auto;">
            </template>
            <template v-for="section in sections">
                <h4>@{{section.name}}</h4>
                <strong>Survey</strong>
                <p>
                    @{{section.survey}}
                </p>
                <template v-if="section.options">
                    <div v-for="(optionKey, option) in section.options" style="margin-bottom: 30mm; margin-left: 5mm">
                        <template v-if="option.system">
                            <h6 style="margin-bottom: 0;"><span>Option @{{optionKey+1}}</span> - @{{option.name}}</h6>
                            <p>
                                @{{option.system.description}}
                            </p>
                            <div style="margin-left: 5mm">
                                <strong>Scope of Work</strong>
                                <ul v-if="option.selectedTasks">
                                    <li v-for="(taskKey, task) in option.selectedTasks">@{{option.system.tasks[taskKey].description}}</li>
                                </ul>
                                <div v-if="option.notes">
                                    <strong>Please note</strong>
                                    <h5 v-for="note in option.notes">@{{note.note}}</h5>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </template>
        </div>
        <div class="proposal-section" v-if="sections">
            <h5>Price Structure</h5>
            <small>(Prices exclude V.A.T.)</small>
            <h6>The following price structure includes:</h6>
            <ul>
                <li>All Materials required to complete the full scope of work described above.</li>
                <li>All labour (skilled).</li>
                <li>Onsite Trained Supervisors.</li>
                <li>All tools, machinery and equipment.</li>
                <li>Staff PPE and all relevant safety equipment.</li>
                <li>All P,s and G,s </li>
                <li>Site Establishment</li>
                <li>Scaffolding</li>
            </ul>
            <h6>The following price structure excludes:</h6>
            <ul>
                <li>Skip Hire (Rubble)</li>
            </ul>
            <template v-for="section in sections">
                <template v-if="section.options">
                    <strong>Price</strong>
                    <table cellpadding="5mm" style="width: 190mm">
                        <tr v-for="(optionKey, option) in section.options">
                            <td style="width: 70%"><h6><span>Option @{{optionKey+1}}</span> - @{{option.name}}</h6></td>
                            <td style="width: 30%"><h6>@{{option.total_cost_price+((option.total_cost_price/100)*option.markup) | currency 'R'}}</h6></td>
                        </tr>
                    </table>
                </template>
            </template>
            <h6>Please Note:</h6>
            <ul>
                <li>All above prices Exclude VAT and are valid for 30 days</li>
                <li>Any errors and/or omissions are excluded. </li>
                <li>Any guarantees offered will only come into effect once the contract is complete and the contract amount has been paid in full. </li>
                <li>Whilst the utmost care and stringent safety procedures are followed, Sanika cannot be held liable for any damages or breakages of the surrounding areas (including tiles) and or injuries to persons whilst working on the roof.</li>
                <li>Pricing outlined above excludes tiling and tiles. Tiles to be purchased by client and installed by others.</to>
                <li>A 60% deposit is required on order with balance payable on completion of the job. </li>
                <li>Pricing above is outlined for all sections to be done concurrently.</li>
                <li>Client is responsible for the integrity of the underlying substrate for adhesion of waterproofing materials.</li>
            </ul>
            <h6>Personnel</h6>
            <p>All Sanika staff to be utilised on site are highly experienced</p>
            <p>All Sanika staff are covered by Workman's Compensation insurance and all projects are covered by consequential damage and public liability insurance.</p>

            <h6>BEE Status</h6>
            <p>Sanika has a certified verification of a Broad Based Level 3 Contributor</p>
        </div>
        <div class="proposal-section" v-if="sections">
            <h6>References</h6>
            <p>We have successfully completed many projects nationwide within the following major Industrial groups. Please feel free to contact any of the following:</p>
            <table cellpadding="5mm" style="width: 190mm; font-size: 11pt">
                <tr>
                    <td style="width: 70mm">Mr. Paul Finney</td>
                    <td>
                        Group Executive<br/>
                        Impala Platinum Refineries Springs
                    </td>
                </tr>
                <tr>
                    <td>Mr Andy Gascoyne</td>
                    <td>
                        Plant Engineer<br/>
                        Impala Platinum PMR
                    </td>
                </tr>
                <tr>
                    <td>Mr Joseph Roux</td>
                    <td>
                        Engineering Manager<br/>
                        Impala Platinum BMR
                    </td>
                </tr>
                <tr>
                    <td>Mr Des Heaney</td>
                    <td>
                        Head Capital Procurement<br/>
                        Impala Platinum Springs
                    </td>
                </tr>
                <tr>
                    <td>Mr Burt Evans</td>
                    <td>
                        Capital Procurement manager<br/>
                        Impala Platinum Refineries
                    </td>
                </tr>
                <tr>
                    <td>Mr Phil Bowker</td>
                    <td>Bowker Greaves Partnership</td>
                </tr>
                <tr>
                    <td>Mr J Verwey</td>
                    <td>
                        Senior Engineer<br/>
                        Growth Point Properties
                    </td>
                </tr>
                <tr>
                    <td>Mr G Bodilly</td>
                    <td>
                        Project Manager - KZN<br/>
                        JHI
                    </td>
                </tr>
                <tr>
                    <td>Mr J Boer</td>
                    <td>
                        Engineering Manager<br/>
                        East Rand Mall
                    </td>
                </tr>
                <tr>
                    <td>Mr G. Puckle</td>
                    <td>
                        Engineering Manager<br/>
                        Johnson Matthey Group
                    </td>
                </tr>
                <tr>
                    <td>Mrs. A. Tosen</td>
                    <td>
                        M-Net Group Properties<br/>
                        (NMSCOM) Randburg
                    </td>
                </tr>
                <tr>
                    <td>Mr M Stephanou</td>
                    <td>Spar Stores</td>
                </tr>
                <tr>
                    <td>Mr K Khumalo</td>
                    <td>
                        Project Specialist<br/>
                        Liberty Properties
                    </td>
                </tr>
                <tr>
                    <td>Mr G Von Der Becke</td>
                    <td>Growthpoint Properties</td>
                </tr>
                <tr>
                    <td>Mr A Amien</td>
                    <td>Tiger Brands</td>
                </tr>
                <tr>
                    <td>Mr V Bhana</td>
                    <td>
                        Project Engineer<br/>
                        G &amp; H Consulting Engineers
                    </td>
                </tr>
                <tr>
                    <td>Mr Bruce Hansen</td>
                    <td>
                        Lead Project Engineer<br/>
                        G &amp; H Consulting Engineers
                    </td>
                </tr>
                <tr>
                    <td>Mr Hannes Weppener</td>
                    <td>
                        Project Director / Engineering Manager<br/>
                        Impala Minpro Rustenburg
                    </td>
                </tr>
                <tr>
                    <td>Mr Mario Portela</td>
                    <td>
                        Senior Engineer<br/>
                        Semane Civil &amp; Structural Engineers<br/>
                        Impala Platinum Projects
                    </td>
                </tr>
                <tr>
                    <td>Mr Jimmy Ioannou</td>
                    <td>JIA Waterproofing Consultants</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>