const switcher = document.querySelector(".theme-switcher");
const html = document.documentElement;
const switcherCircle = document.querySelector(".theme-switcher--circle");

// If the dark theme is set, after reload we want the circle to be translated right
if (localStorage.theme === "dark") {
  switcherCircle.style.transform = "translateX(23px)";
}

// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (
  localStorage.theme === "dark" ||
  (!("theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  html.classList.add("dark");
} else {
  html.classList.remove("dark");
}

// Define what happens on switcher click
switcher.addEventListener("click", () => {
  // If we are switching to dark, do logic
  if (localStorage.theme === "" || localStorage.theme === "light") {
    html.classList.add("dark");

    if (html.classList.contains("light")) {
      html.classList.remove("light");
    }

    localStorage.theme = "dark";
    switcherCircle.style.transform = "translateX(23px)";
  } else {
    // If we are switching to light, do logic
    html.classList.remove("dark");
    html.classList.add("light");
    localStorage.theme = "light";
    switcherCircle.style.transform = "translateX(0)";
  }
});

// Display/close modal window on mobile screens
const filterBtn = document.querySelector(".filter-btn");
const formModal = document.querySelector(".form-modal");

if (filterBtn) {
  // Open the modal menu when clicked on filter btn
  filterBtn.addEventListener("click", () => {
    if (formModal.classList.contains("hidden")) {
      formModal.classList.remove("hidden");
    } else {
      formModal.classList.add("hidden");
    }
  });

  // Close the modal menu when clicked outsied
  document.body.addEventListener("click", (e) => {
    if (e.target !== filterBtn) {
      if (
        !formModal.classList.contains("hidden") &&
        !e.target.closest(".modal-window")
      ) {
        formModal.classList.add("hidden");
      }
    }
  });
}
