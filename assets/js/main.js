window.showCustomModal = function({title = "Notice", message = "", buttons = [], type = ""}) {
    const alertModal = document.getElementById("bootstrapAlertModal");
    const $header = $(".modal-header");

    // Set title and message
    $(".modal-title").text(title);
    $("#bootstrapAlertBody").text(message);

    // Clean up previous type classes
    $header.className = "modal-header"; // Reset

    // Optionally apply type class to header
    if (type) {
        $header.addClass("bg-" + type + " text-white");
    }

    const $footer = $(".modal-footer");
    $footer.empty(); // Clear previous buttons

    // Add custom buttons
    buttons.forEach((btn) => {
        const button = document.createElement("button");
        button.className = "btn " + (btn.class || "btn-secondary");
        button.textContent = btn.label || "OK";

        // Attach click handler
        button.addEventListener("click", () => {
            if (btn.onClick) btn.onClick(); // Call user's function
            bootstrap.Modal.getInstance(alertModal).hide();
        });

        $footer.append(button);
    });

    // Show modal
    const modal = new bootstrap.Modal(alertModal);
    modal.show();
}

window.togglePassword = function (button) {
    const $input = button.siblings('input');
    const type = $input.attr('type') === 'password' ? 'text' : 'password';
    $input.attr('type', type);

    button.children('i').toggleClass('bi-eye bi-eye-slash');
}

window.showAlert = function(message, type, durration = 3000) {
    const $alertContainer = $('#alert-container');
    const $alert = $('<div>', {
        class: 'custom-alert ' + type,
        text: message
    })

    $alertContainer.append($alert);

    setTimeout(() => {
        $alert.addClass('fade-out');

        setTimeout(() => {
            $alert.remove();
        }, 500);
    }, durration);
}
