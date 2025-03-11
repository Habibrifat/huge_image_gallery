jQuery(document).ready(function ($) {
  let masonryInitialized = false; // Flag to track initialization

  // Function to initialize Masonry
  function initializeMasonry() {
    if (masonryInitialized) return; // Skip if already initialized

    var $gallery = $(".advanced-image-gallery.huge-masonry");

    if ($gallery.length) {
      console.log("Masonry container found. Initializing...");
      $gallery.imagesLoaded(function () {
        console.log("Images loaded. Initializing Masonry...");
        $gallery.masonry({
          itemSelector: ".huge-gallery-item",
          columnWidth: ".huge-gallery-item",
          percentPosition: true,
        });

        // Force Masonry to recalculate layout after initialization
        $gallery.masonry("layout");
        console.log("Masonry initialized successfully");
        masonryInitialized = true; // Set flag to true
      });
    } else {
      console.log("Masonry container not found.");
    }
  }

  // Initialize Masonry in the frontend
  initializeMasonry();

  // Initialize Masonry in the Elementor editor
  if (window.elementorFrontend) {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/huge-advanced-image-gallery.default",
      function () {
        console.log("Elementor widget is ready. Initializing Masonry...");
        setTimeout(function () {
          initializeMasonry();
        }, 1000); // Add a delay to ensure the DOM is ready
      }
    );
  }

  // Force initialization in the Elementor editor after render
  if (window.elementor && window.elementor.channels) {
    elementor.channels.editor.on("render", function () {
      setTimeout(function () {
        console.log("Elementor editor rendered. Initializing Masonry...");
        initializeMasonry();
      }, 1000); // Add a delay to ensure the DOM is ready
    });
  }

  // Reinitialize Masonry on control changes
  if (window.elementor && window.elementor.channels) {
    elementor.channels.editor.on("change", function (model) {
      setTimeout(function () {
        console.log("Elementor control changed. Reinitializing Masonry...");
        initializeMasonry();
      }, 1000); // Add a delay to ensure the DOM is updated
    });
  }
});
