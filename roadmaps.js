const roadmapData = [
    {
        year: 1,
        title: "Foundation & Exploration",
        description: "Focus on building a strong academic foundation and exploring various technical interests.",
        academics: ["Mathematics", "Physics & Chemistry", "C Programming", "Basic Electrical Engineering", "GPA > 8.5"],
        coding: ["C Programming Mastery", "HTML/CSS Basics", "GitHub Basics", "HackerRank Start"],
        softSkills: ["Communication", "Public Speaking", "Time Management", "Teamwork"],
        careerPrep: ["Join Tech Clubs", "LinkedIn Setup", "Explore IT Field"]
    },
    {
        year: 2,
        title: "Core Strengthening",
        description: "Deep dive into CS fundamentals.",
        academics: ["DSA", "OOPs", "DBMS", "Discrete Math"],
        coding: ["DSA Practice", "Java/C++", "Python Basics", "Mini Projects"],
        softSkills: ["Aptitude Basics", "Resume Building", "GD Practice"],
        careerPrep: ["Internships", "Hackathons", "Portfolio Website"]
    },
    {
        year: 3,
        title: "Specialization & Application",
        description: "Placement preparation phase.",
        academics: ["OS", "CN", "SE", "DAA"],
        coding: ["Advanced DSA", "React/Node", "SQL", "400+ Problems"],
        softSkills: ["Mock Interviews", "Leadership", "Aptitude Advanced"],
        careerPrep: ["Internships", "SIH", "Resume Finalization"]
    },
    {
        year: 4,
        title: "Placement & Transition",
        description: "Final placement phase.",
        academics: ["Major Project", "Electives"],
        coding: ["System Design", "Revision", "Final Project"],
        softSkills: ["Interview Skills", "HR Prep", "Stress Management"],
        careerPrep: ["Campus Drives", "Job Offers", "Career Transition"]
    }
];

let activeYear = 1;

function init() {
    renderAll();
    if (window.lucide) lucide.createIcons();
}

function renderYearSelector() {
    const selector = document.getElementById("year-selector");
    selector.innerHTML = "";

    roadmapData.forEach(y => {
        const btn = document.createElement("button");

        btn.className =
            "px-8 py-3 rounded-xl text-xs font-black tracking-widest uppercase transition-all " +
            (activeYear === y.year
                ? "bg-indigo-600 text-white"
                : "bg-white text-slate-600 hover:text-indigo-600 border border-slate-200");

        btn.innerText = "Year 0" + y.year;

        btn.onclick = () => {
            activeYear = y.year;
            renderAll();
        };

        selector.appendChild(btn);
    });
}

function renderContent() {
    const data = roadmapData.find(y => y.year === activeYear);
    const container = document.getElementById("roadmap-content");

    container.innerHTML = `
        <div class="grid lg:grid-cols-12 gap-10">

            <div class="lg:col-span-4">
                <h2 class="text-3xl font-black text-slate-800 mb-4">${data.title}</h2>
                <p class="text-slate-500 font-medium mb-6">${data.description}</p>
            </div>

            <div class="lg:col-span-8 grid md:grid-cols-2 gap-6">

                ${renderBox("Academics", data.academics)}
                ${renderBox("Coding", data.coding)}
                ${renderBox("Soft Skills", data.softSkills)}
                ${renderBox("Career Prep", data.careerPrep)}

            </div>

        </div>
    `;

    if (window.lucide) lucide.createIcons();
}

function renderBox(title, items) {
    return `
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-slate-400 font-semibold mb-4 uppercase tracking-wide text-xs">${title}</h3>
            <ul class="space-y-2">
                ${items.map(i => `<li class="text-slate-700 text-sm font-medium">• ${i}</li>`).join("")}
            </ul>
        </div>
    `;
}

function renderAll() {
    renderYearSelector();
    renderContent();
}

init();