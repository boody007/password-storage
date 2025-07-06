// Alert removal animation
function alertRemoval() {
    const bsAlert = document.querySelector('.alert');
    setTimeout(() => {
        bsAlert.style.animation = "alert-dismiss 0.25s ease-in-out";
        bsAlert.addEventListener('animationend', () => {
            bsAlert.remove();
        });
    }, 3000);
}

alertRemoval();
// Alert initialization
function initializeAlert(alertType, alertContent) {
    switch (alertType) {
        case "danger":
            document.body.innerHTML += `<div class="alert alert-${alertType}"><i class="fa-circle-xmark"></i> ${alertContent}.</div>`;
        break;
        case "warning":
            document.body.innerHTML += `<div class="alert alert-${alertType}"><i class="fa-triangle-exclamation"></i> ${alertContent}.</div>`;
        break;
        case "primary":
            document.body.innerHTML += `<div class="alert alert-${alertType}"><i class="fa-circle-xmark"></i> ${alertContent}.</div>`;
        break;
        case "success":
            document.body.innerHTML += `<div class="alert alert-${alertType}"><i class="fa-circle-info"></i> ${alertContent}.</div>`;
        break;
    }
    // Removing Alert
    alertRemoval();
}
// Getting the URL from the service name
window.addEventListener("DOMContentLoaded", grabIcons());

function grabIcons() {
    const table = document.querySelector(".table");
    const rows = table.querySelectorAll("tr");
    try {
        rows.forEach(async function (row) {
            // Skip the first row (header)
            if (row.rowIndex === 0) return;

            // Simple in-memory cache for logos and domains
            if (!window._logoCache) window._logoCache = {};

            const serviceNameElem = row.querySelector(".service-name");
            if (!serviceNameElem) return;
            const serviceName = serviceNameElem.textContent.trim();

            // Helper to update row with logo and domain
            function updateLayout(row, domain, logo) {
                const th = row.querySelector("th");
                if (th && logo) {
                    th.innerHTML = `<img src="${logo}" height="32" alt="${serviceName} logo">`;
                }
                const serviceUrlLink = row.querySelector(".service-url");
                if (serviceUrlLink && domain) {
                    serviceUrlLink.querySelector("a").setAttribute("href", "https://" + domain);
                    serviceUrlLink.querySelector("a").textContent = domain;
                }
            }

            // Use cache if available
            if (window._logoCache[serviceName]) {
                const { domain, logo } = window._logoCache[serviceName];
                updateLayout(row, domain, logo);
                return;
            }

            // Fetch and cache if not available
            const response = await fetch(`https://autocomplete.clearbit.com/v1/companies/suggest?query=${encodeURIComponent(serviceName)}`);
            const urlResults = await response.json();
            if (urlResults.length) {
                var thIndex = row.querySelector("th").getAttribute("data-index");
                switch (thIndex) {
                    case "0":
                        var { domain, logo } = urlResults[0];
                        window._logoCache[serviceName] = { domain, logo };
                        updateLayout(row, domain, logo);
                        break;
                    case "1":
                        var { domain, logo } = urlResults[1];
                        window._logoCache[serviceName] = { domain, logo };
                        updateLayout(row, domain, logo);
                        break;
                    case "2":
                        var { domain, logo } = urlResults[2];
                        window._logoCache[serviceName] = { domain, logo };
                        updateLayout(row, domain, logo);
                        break;
                    case "3":
                        var { domain, logo } = urlResults[3];
                        window._logoCache[serviceName] = { domain, logo };
                        updateLayout(row, domain, logo);
                        break;
                    case "4":
                        var { domain, logo } = urlResults[4];
                        window._logoCache[serviceName] = { domain, logo };
                        updateLayout(row, domain, logo);
                        break;
                }
            } else {
                window._logoCache[serviceName] = {};
                console.log("No official domain for service " + serviceName);
                row.querySelector(".service-url").innerHTML = "<div class='text-muted fst-italic'>No URLs for now</div>";
                row.querySelector(".service-url").classList.remove("text-decoration-underline");
                row.querySelector(".service-url div").style.marginTop = "10px !important";
            }
        });
    }
    catch (error) {
        console.error(error);
    }
}

// Setting a default image for the services that it's not found
const tableRowsHeads = document.querySelectorAll(".table tr");
var count = 0;
tableRowsHeads.forEach((row) => {
    if (count > 0) {
        if (!row.querySelector("th").contains(row.querySelector("img"))) {
            row.querySelector("th").innerHTML = "<img src='https://mcicons.ccleaf.com/assets/10.%20Items/21.%20Decoration/Painting.png' height='32'>";
        }
    }
    count++;
})

// Filter Table
document.getElementById('filter').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const table = document.querySelector('.table');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
        const cells = rows[i].getElementsByTagName('td');
        let found = false;

        for (let j = 0; j < cells.length; j++) {
            const cellText = cells[j].textContent.toLowerCase();
            if (cellText.includes(filter)) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? '' : 'none';
    }
});

// Cutting passwords card notes
const passwordsCols = document.querySelectorAll(".details .row .col");
window.addEventListener("DOMContentLoaded", () => {
    passwordsCols.forEach((passwordcol) => {
        const notes = passwordcol.querySelector(".notes");
        if (notes.textContent != "No Notes" && !notes.classList.contains("fst-italic")) {
            const notesContent = notes.textContent;
            notes.textContent = notesContent.slice(0, 30);
        }
    });
});

passwordsCols.forEach((passwordcol) => {
    var buttons = passwordcol.querySelectorAll(".card .clipboard-add");
    buttons.forEach((button) => {
        var buttonTarget = button.getAttribute("data-target");
        var textToCopy = "";
        switch (buttonTarget) {
            case "login":
                textToCopy = passwordcol.querySelector(".card #login").textContent;
            break;
            case "password":
                textToCopy = passwordcol.querySelector(".card #password").textContent;
            break;
        }
        // Copying to clipboard
        navigator.clipboard.writeText(textToCopy).then(() => {initializeAlert("success", "Text copied to clipboard")}).catch(error => {initializeAlert("danger", "Something went wrong in copying! => " + error)});
    })
});