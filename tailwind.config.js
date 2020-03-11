module.exports = {
	theme: {
		extend: {
			screens: {
				'print': {'raw': 'print'},
				 // => @media  print { ... }
			}
		}
	},
	variants: {},
	plugins: [
		require('@tailwindcss/custom-forms')
	]
}
