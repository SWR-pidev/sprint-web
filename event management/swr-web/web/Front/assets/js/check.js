$("html").mousedown(function (e) {
    if (e.target != document.getElementById("a"))
        alert("Please login first!");
});