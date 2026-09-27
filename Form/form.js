// script.js ෆයිල් එක ඇතුළට මේ ටික විතරක් දාන්න (<script> tags ඕන නැත)

function openModal(event) {
    event.preventDefault();
    document.getElementById('plannerModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('plannerModal').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('plannerModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

function handleFormSubmit(event) {
    event.preventDefault();
    alert('Your itinerary request has been submitted successfully!');
    closeModal();
}

// Page එක Load වෙනකොට URL එකේ openModal=true තියෙනවාද බලලා Form එක open කිරීම
window.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('openModal') === 'true') {
        // Modal එක open කිරීමට function එක call කිරීම
        const modal = document.getElementById('plannerModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }
});

// Feature 1: Form Validation & Submission Handling
function handleFormSubmit(event) {
    event.preventDefault();

    // Form එකේ inputs ලබා ගැනීම (plannerModal ඇතුළෙන් ආරක්ෂිතව තෝරා ගැනීම)
    const modal = document.getElementById('plannerModal');
    const destInput = modal ? modal.querySelector('input[type="text"]') : document.querySelector('input[type="text"]');
    const dateInputs = modal ? modal.querySelectorAll('input[type="date"]') : document.querySelectorAll('input[type="date"]');

    const destination = destInput ? destInput.value.trim() : "";
    const startDate = dateInputs.length > 0 ? dateInputs[0].value : "";
    const endDate = dateInputs.length > 1 ? dateInputs[1].value : "";

    // Simple Validation Check
    if (destination === "") {
        alert("Please enter a destination!");
        return;
    }

    if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
        alert("End Date must be after Start Date!");
        return;
    }

    alert(`Success! Itinerary requested for ${destination}.`);
    closeModal();
}