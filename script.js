document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    const errorMsg = document.getElementById("error-message");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const response = await fetch("login.php", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (result.status === "success") {
                window.location.href = "index.php";
            } else {
                errorMsg.textContent = result.message;
            }

        } catch (error) {
            errorMsg.textContent = "⚠️ An unexpected error occurred.";
            console.error("Error:", error);
        }
        
    });
});
