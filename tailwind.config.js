/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Core Colors
        brand: {
          blue: '#0286C3', // Brand Blue (links, active, primary CTA)
          blueDark: '#0073AA', // Blue Dark (hover)
          teal: '#17B897', // Teal (success, highlights)
        },
        // Neutral Scale
        text: {
          primary: '#1B1E28', // Text Primary
          secondary: '#536171', // Text Secondary
          muted: '#8DA4BE', // Text Muted
        },
        bg: {
          app: '#F7F9FA', // Background
        },
        surface: '#FFFFFF', // Surface
        border: {
          core: '#CFD9E0', // Border
          subtle: '#E5EBED', // Border Subtle
        },
        // Semantic Colors
        semantic: {
          success: '#17B897',
          warning: '#F5A623',
          error: '#D32F2F',
          info: '#0286C3',
        }
      },
      fontFamily: {
        sans: ['"Avenir Next"', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', 'Helvetica', 'Arial', 'sans-serif'],
        mono: ['Mono', 'monospace'],
      },
      borderRadius: {
        none: '0px',
        sm: '4px',
        md: '6px',
      },
      boxShadow: {
        flat: 'none',
        raised: '0 1px 2px rgba(0,0,0,0.1)',
        overlay: '0 4px 8px rgba(0,0,0,0.12)',
        modal: '0 8px 24px rgba(0,0,0,0.15)',
      },
      // Spacing Scale
      spacing: {
        'tight-gap': '4px',
        'form-pad': '8px',
        'btn-pad': '12px',
        'card-pad': '16px',
        'sec-sep': '24px',
        'comp-block': '32px',
        'page-sec': '48px',
      }
    },
  },
  plugins: [],
}
