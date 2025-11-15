// the showform function used to display a specific form based on the formId passed
// this is a way to toggle between the login and register forms without moving to a different page of the website(single page application)
function showForm(formId) {
    document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active")); //for all form-box elements, remove the active class
    document.getElementById(formId).classList.add("active"); //add the active class to the form with the specified formId to be displayed
}