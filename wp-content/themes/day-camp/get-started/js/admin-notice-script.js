jQuery(document).ready(function ($) {
    // Attach click event to the dismiss button
    $(document).on('click', '.notice[data-notice="get-start"] button.notice-dismiss', function () {
        // Dismiss the notice via AJAX
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'day_camp_dismissed_notice',
            },
            success: function () {
                // Remove the notice on success
                $('.notice[data-notice="example"]').remove();
            }
        });
    });
});

// Plugin – AI Content Writer plugin activation
document.addEventListener('DOMContentLoaded', function () {
    const day_camp_button = document.getElementById('install-activate-button');

    if (!day_camp_button) return;

    day_camp_button.addEventListener('click', function (e) {
        e.preventDefault();

        const day_camp_redirectUrl = day_camp_button.getAttribute('data-redirect');

        // Step 1: Check if plugin is already active
        const day_camp_checkData = new FormData();
        day_camp_checkData.append('action', 'check_plugin_activation');

        fetch(installPluginData.ajaxurl, {
            method: 'POST',
            body: day_camp_checkData,
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.data.active) {
                // Plugin is already active → just redirect
                window.location.href = day_camp_redirectUrl;
            } else {
                // Not active → proceed with install + activate
                day_camp_button.textContent = 'Installing & Activating...';

                const day_camp_installData = new FormData();
                day_camp_installData.append('action', 'install_and_activate_required_plugin');
                day_camp_installData.append('_ajax_nonce', installPluginData.nonce);

                fetch(installPluginData.ajaxurl, {
                    method: 'POST',
                    body: day_camp_installData,
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = day_camp_redirectUrl;
                    } else {
                        alert('Activation error: ' + (res.data?.message || 'Unknown error'));
                        day_camp_button.textContent = 'Try Again';
                    }
                })
                .catch(error => {
                    alert('Request failed: ' + error.message);
                    day_camp_button.textContent = 'Try Again';
                });
            }
        })
        .catch(error => {
            alert('Check request failed: ' + error.message);
        });
    });
});
