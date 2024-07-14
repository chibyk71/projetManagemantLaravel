import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
	corePlugins: {
		preflight: false,
	},
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./resources/js/**/*.svelte',
	],
	theme: {
		extend: {
			fontFamily: {
				sans: ['Figtree', ...defaultTheme.fontFamily.sans],
			},
			screens: {
				// Don't need xs since Tailwind uses min-width approach
				// to its media queries.
				sm: '576px',
				md: '768px',
				lg: '992px',
				xl: '1200px',
				xxl: '1400px',
			},
			container: {
				center: true,
				padding: "0.75rem",
			},
			maxWidth: {
				sm: `${540 / 16}rem`,
				md: `${720 / 16}rem`,
				lg: `${960 / 16}rem`,
				xl: `${1140 / 16}rem`,
				xxl: `${1320 / 16}rem`,
			},
		}
	},
	plugins: [forms],
};
