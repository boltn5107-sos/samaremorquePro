/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#0f172a',
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#334155',
          800: '#1e293b',
          900: '#0f172a',
        },
        accent: {
          DEFAULT: '#f97316',
          50: '#fff7ed',
          100: '#ffedd5',
          200: '#fed7aa',
          300: '#fdba74',
          400: '#fb923c',
          500: '#f97316',
          600: '#ea580c',
          700: '#c2410c',
          800: '#9a3412',
          900: '#7c2d12',
        },
        night: {
          DEFAULT: '#0c1222',
          50: '#f4f6fb',
          100: '#e8ecf4',
          800: '#151d33',
          900: '#0c1222',
        },
      },
      fontFamily: {
        sans: ['Manrope', 'ui-sans-serif', 'system-ui'],
        display: ['Space Grotesk', 'Manrope', 'ui-sans-serif', 'system-ui'],
      },
    },
  },
  plugins: [],
};