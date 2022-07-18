module.exports = {
  content: ["**/*.twig", "../../../modules/**/*.twig"],
  theme: {
    extend: {
      fontFamily: {
        "kumbh-sans": ['"Kumbh Sans"', "sans-serif"],
        body: '"Kumbh Sans"',
      },
      colors: {
        bluegray: "#6E8098",
        lightblue: "#5964E0",
        lightestblue: "#939BF4",
        lightgray: "#F2F2F2",
        lightblack: "#19202D",
        darkblack: "#121721",
        darkblue: "#19202D",
        darkgray: "#9DAEC2",
      },
    },
  },
  darkMode: "class",
  variants: {
    extend: {},
  },
  plugins: [],
};
