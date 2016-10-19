<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;" width="100%">
	<tbody>
		<tr>
			<td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
				<p style="font-family: sans-serif; font-size: 14px; font-weight: bold; margin: 0;">
					Material List
				</p>
			</td>
		</tr>
		<tr>
			<td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
				<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
					<tbody>
						<tr>
							<th width="70%" style="font-family: sans-serif; font-size: 12px; font-weight: bold; vertical-align: top; background-color: '#FFFFFF'; text-align: left; width: 70%" valign="top" bgcolor="#FFFFFF" align="left">
								name
							</th>
							<th style="font-family: sans-serif; font-size: 12px; font-weight: bold; vertical-align: top; background-color: '#FFFFFF'; text-align: left;" valign="top" bgcolor="#FFFFFF" align="left">
								required
							</th>
							<th style="font-family: sans-serif; font-size: 12px; font-weight: bold; vertical-align: top; background-color: '#FFFFFF'; text-align: left;" valign="top" bgcolor="#FFFFFF" align="left">
								available
							</th>
						</tr>
						@foreach($option->materials as $matKey => $material)
						<tr>
							<td style="font-family: sans-serif; font-size: 14px; vertical-align: top; color: {{$material->stock < $material->pivot->qty ? '#FF0000':'#000000'}}; background-color: {{$matKey%2==0 ? '#F1F1F1':'#FFFFFF'}}; text-align: left;" valign="top" bgcolor="{{$matKey%2==0 ? '#F1F1F1':'#F1F1F1'}}" align="left">
								{{$material->name}}
							</td>
							<td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: {{$matKey%2==0 ? '#F1F1F1':'#FFFFFF'}}; text-align: left;" valign="top" bgcolor="{{$matKey%2==0 ? '#F1F1F1':'#F1F1F1'}}" align="left">
								{{$material->pivot->qty}}
							</td>
							<td style="font-family: sans-serif; font-size: 14px; vertical-align: top; color: {{$material->stock < $material->pivot->qty ? '#FF0000':'#000000'}}; background-color: {{$matKey%2==0 ? '#F1F1F1':'#FFFFFF'}}; text-align: left;" valign="top" bgcolor="{{$matKey%2==0 ? '#F1F1F1':'#F1F1F1'}}" align="left">
								{{$material->stock}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>