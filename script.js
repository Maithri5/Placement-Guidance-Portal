function showTech() {
    const tech = document.getElementById("tech");
    const nontech = document.getElementById("nontech");

    const techBtn = document.getElementById("techBtn");
    const nonTechBtn = document.getElementById("nonTechBtn");

    // Show/Hide Sections
    tech.classList.remove("hidden");
    nontech.classList.add("hidden");

    // Button Active State
    techBtn.classList.add("active");
    nonTechBtn.classList.remove("active");
}

function showNonTech() {
    const tech = document.getElementById("tech");
    const nontech = document.getElementById("nontech");

    const techBtn = document.getElementById("techBtn");
    const nonTechBtn = document.getElementById("nonTechBtn");

    // Show/Hide Sections
    nontech.classList.remove("hidden");
    tech.classList.add("hidden");

    // Button Active State
    nonTechBtn.classList.add("active");
    techBtn.classList.remove("active");
}


// ==============================
// ROADMAP PAGE LOGIC
// ==============================

function selectYear(year) {
    const branchSection = document.getElementById("branchSection");

    // Show branch options
    branchSection.classList.remove("hidden");

    // Optional: highlight selected year
    const buttons = document.querySelectorAll(".year-buttons button");
    buttons.forEach(btn => btn.classList.remove("active"));

    buttons[year - 1].classList.add("active");
}


// ==============================
// OPTIONAL: PAGE LOAD DEFAULT
// ==============================

document.addEventListener("DOMContentLoaded", () => {
    // Ensure Tech is default selected
    const tech = document.getElementById("tech");
    if (tech) {
        showTech();
    }
});

document.addEventListener("DOMContentLoaded", function () {

    const headers =
        document.querySelectorAll(".accordion-header");

    headers.forEach(header => {

        header.addEventListener("click", function () {

            const item =
                this.parentElement;

            const allItems =
                document.querySelectorAll(".accordion-item");

            // Close other topics
            allItems.forEach(i => {
                if (i !== item) {
                    i.classList.remove("open");
                }
            });

            // Toggle clicked topic
            item.classList.toggle("open");

        });

    });

});
// SEARCH FUNCTION

// SEARCH FUNCTION

document.addEventListener("DOMContentLoaded", function () {

    const searchInput =
        document.getElementById("searchInput");

    const searchClear =
        document.getElementById("searchClear");

    const accordionItems =
        document.querySelectorAll(".accordion-item");

    searchInput.addEventListener("input", function () {

        const searchText =
            this.value.toLowerCase();

        accordionItems.forEach(item => {

            const title =
                item.querySelector(".acc-title")
                .textContent
                .toLowerCase();

            const questions =
                item.querySelectorAll(".question-item");

            let matchFound = false;

            // Check topic name
            if (title.includes(searchText)) {
                matchFound = true;
            }

            // Check questions
            questions.forEach(q => {

                const text =
                    q.textContent.toLowerCase();

                if (text.includes(searchText)) {
                    matchFound = true;
                }

            });

            if (matchFound) {
                item.classList.remove("hidden");
            } else {
                item.classList.add("hidden");
            }

        });

    });

    /* ---------------- DIFFICULTY FILTER ---------------- */

const filterButtons =
    document.querySelectorAll(".filter-btn");

const questionItems =
    document.querySelectorAll(".question-item");

filterButtons.forEach(button => {

    button.addEventListener("click", function () {

        const selected =
            this.dataset.difficulty;

        // Active button highlight
        filterButtons.forEach(btn =>
            btn.classList.remove("active")
        );

        this.classList.add("active");

        questionItems.forEach(question => {

            const diffTag =
                question.querySelector(".difficulty-tag");

            const difficulty =
                diffTag.classList[1]; // easy/medium/hard

            if (selected === "all" ||
                difficulty === selected) {

                question.style.display = "block";

            } else {

                question.style.display = "none";

            }

        });

    });

});

    // CLEAR BUTTON

    searchClear.addEventListener("click", function () {

        searchInput.value = "";

        accordionItems.forEach(item => {
            item.classList.remove("hidden");
        });

    });

});

function goBack() {

    // If browser has history
    if (window.history.length > 1) {

        history.back();

    } 
    // Otherwise go to home
    else {

        window.location.href = "index.html";

    }

}