<?php
/**
 * Functions file for Hello Elementor Child/Parent
 */

// Load Assets (Tailwind CDN + Fonts)
function custom_load_assets() {
    // 1. Font Awesome
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css' );

    // 2. Google Fonts: Oswald & Inter (Vacasky Style)
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Oswald:wght@400;500;700&display=swap' );

    // 3. Tailwind CSS (CDN) - Langsung jalan tanpa install npm
    echo '<script src="https://cdn.tailwindcss.com"></script>';
    echo '<script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                vacasky: {
                  blue: "#56B4E9",
                  dark: "#111111",
                  gray: "#666666",
                  light: "#F4F8FB"
                }
              },
              fontFamily: {
                sans: ["Inter", "sans-serif"],
                heading: ["Oswald", "sans-serif"]
              }
            }
          }
        }
    </script>';
}
add_action( 'wp_head', 'custom_load_assets' );

// Matikan style bawaan Hello Elementor yang mungkin bikin padding aneh
add_filter( 'hello_elementor_enqueue_style', '__return_false' );
add_filter( 'hello_elementor_enqueue_theme_style', '__return_false' );
?>