// This script is loaded both on the frontend page and in the Visual Builder.

jQuery(function($) {});

(function($) {
  "use strict";

  // When DOM is fully loaded
  $(document).ready(function() {
    // Ensure custom styles are applied immediately after page load
    $(".owl-social-share-buttons").each(function() {
      const $container = $(this);

      // Force style refresh to ensure custom styling is applied
      if ($container.hasClass("custom-colors")) {
        // Get computed styles and reapply them to force a refresh
        $container.find(".owl-social-share-button").each(function() {
          const $button = $(this);
          const computedStyle = window.getComputedStyle($button[0]);

          // Apply the styles directly to override any potential conflicts
          const backgroundColor = computedStyle.backgroundColor;
          const color = computedStyle.color;
          const fontSize = computedStyle.fontSize;
          const borderColor = computedStyle.borderColor;

          if (backgroundColor) $button.css("background-color", backgroundColor);
          if (color) $button.css("color", color);
          if (borderColor) $button.css("border-color", borderColor);

          // Apply font size to icon and text
          $button.find("i").each(function() {
            const iconFontSize = $(this).css("font-size");
            if (iconFontSize) {
              $(this).css("font-size", iconFontSize);
            }
          });

          // Apply hover state via temporary class
          $button
            .on("mouseenter", function() {
              $(this).addClass("owl-hover-active");
            })
            .on("mouseleave", function() {
              $(this).removeClass("owl-hover-active");
            });
        });
      }
    });

    // Handle print button click
    $(".owl-social-share-print").on("click", function(e) {
      e.preventDefault();
      window.print();
    });

    // Apply hover effects correctly based on button style
    $(".owl-social-share-button").hover(
      function() {
        var $this = $(this);
        var $container = $this.closest('.owl-social-share-buttons');
        var useOriginalColors = $container.hasClass('original-colors');
        var buttonStyle = '';
        
        if ($container.hasClass('style-filled')) buttonStyle = 'filled';
        else if ($container.hasClass('style-outlined')) buttonStyle = 'outlined';
        else if ($container.hasClass('style-minimal')) buttonStyle = 'minimal';
        
        // Store original styles
        $this.data('original-bg', $this.css('background-color'));
        $this.data('original-color', $this.css('color'));
        $this.data('original-border', $this.css('border-color'));
        
        // Apply hover styles based on button type and color settings
        if (!useOriginalColors) {
          var hoverBgColor = $container.data('hover-bg-color');
          var hoverTextColor = $container.data('hover-text-color');
          
          if (buttonStyle === 'filled') {
            $this.css({
              'background-color': hoverBgColor,
              'color': hoverTextColor
            });
          } else if (buttonStyle === 'outlined') {
            $this.css({
              'background-color': hoverBgColor,
              'border-color': hoverBgColor,
              'color': hoverTextColor
            });
          } else if (buttonStyle === 'minimal') {
            $this.css({
              'color': hoverBgColor
            });
          }
        } else {
          // For original colors, handle outlined specially
          if (buttonStyle === 'outlined') {
            var borderColor = $this.css('border-color');
            $this.css({
              'background-color': borderColor,
              'color': '#ffffff'
            });
          }
        }
        
        // Apply animation effects
        var $parentContainer = $this.closest('.owl-social-share-buttons');
        if ($parentContainer.hasClass('hover-grow')) {
          $this.css('transform', 'scale(1.1)');
        } else if ($parentContainer.hasClass('hover-shrink')) {
          $this.css('transform', 'scale(0.9)');
        } else if ($parentContainer.hasClass('hover-float')) {
          $this.css('transform', 'translateY(-5px)');
        } else if ($parentContainer.hasClass('hover-rotate')) {
          $this.css('transform', 'rotate(5deg)');
        }
      },
      function() {
        // Restore original styles
        var $this = $(this);
        $this.css({
          'background-color': $this.data('original-bg'),
          'color': $this.data('original-color'),
          'border-color': $this.data('original-border'),
          'transform': ''
        });
      }
    );
  });
})(jQuery);
