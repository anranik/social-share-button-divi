// External Dependencies
import React, { Component } from "react";

// Internal Dependencies
import "./style.css";

class OwlSocialShareButton extends Component {
  static slug = "owl_social_share_button";

  constructor(props) {
    super(props);
    this.state = {
      shareCounts: {},
    };
  }

  componentDidMount() {
    // Placeholder for share count API calls
    if (this.props.show_count === "on") {
      this.fetchShareCounts();
    }

    // Handle print button click
    const printButtons = document.querySelectorAll(".owl-social-share-print");
    printButtons.forEach((button) => {
      button.addEventListener("click", this.handlePrint);
    });
  }

  componentWillUnmount() {
    // Cleanup event listeners
    const printButtons = document.querySelectorAll(".owl-social-share-print");
    printButtons.forEach((button) => {
      button.removeEventListener("click", this.handlePrint);
    });
  }

  handlePrint = (e) => {
    e.preventDefault();
    window.print();
  };

  fetchShareCounts() {
    // This is a placeholder for real API calls to fetch share counts
    // For a real implementation, you would need to call APIs for each network
    // or use a service that provides this data

    // For demo purposes, setting random counts
    const networks = [
      "facebook",
      "twitter",
      "linkedin",
      "pinterest",
      "reddit",
      "tumblr",
      "whatsapp",
      "telegram",
      "viber",
      "skype",
      "messenger",
      "vk",
      "xing",
    ];

    const mockCounts = {};
    networks.forEach((network) => {
      mockCounts[network] = Math.floor(Math.random() * 100);
    });

    this.setState({ shareCounts: mockCounts });
  }

  render() {
    // Process props
    const {
      title,
      show_title,
      custom_url,
      custom_title,
      custom_description,
      custom_image,

      // Network options
      facebook,
      twitter,
      linkedin,
      pinterest,
      reddit,
      tumblr,
      whatsapp,
      telegram,
      viber,
      skype,
      messenger,
      vk,
      xing,
      email,
      print,

      // Display settings
      button_style,
      button_shape,
      button_size,
      button_layout,
      floating_position,
      mobile_floating_position,
      show_label,
      show_count,
      hover_animation,
      alignment,

      // Advanced settings
      custom_css_class,
      use_original_colors,
      custom_color,
      custom_hover_color,
      custom_text_color,
      custom_text_hover_color,
      spacing,
      icon_font_size,
      label_font_size,
      open_in_new_tab,
      add_rel_nofollow,
    } = this.props;

    // Define networks configuration
    const networks = [
      {
        id: "facebook",
        enabled: facebook === "on",
        name: "Facebook",
        icon: "fab fa-facebook-f",
        url: "https://www.facebook.com/sharer/sharer.php?u={url}&t={title}",
      },
      {
        id: "twitter",
        enabled: twitter === "on",
        name: "Twitter",
        icon: "fab fa-twitter",
        url: "https://twitter.com/intent/tweet?url={url}&text={title}",
      },
      {
        id: "linkedin",
        enabled: linkedin === "on",
        name: "LinkedIn",
        icon: "fab fa-linkedin-in",
        url:
          "https://www.linkedin.com/shareArticle?mini=true&url={url}&title={title}&summary={description}",
      },
      {
        id: "pinterest",
        enabled: pinterest === "on",
        name: "Pinterest",
        icon: "fab fa-pinterest-p",
        url:
          "https://pinterest.com/pin/create/button/?url={url}&media={image}&description={title}",
      },
      {
        id: "reddit",
        enabled: reddit === "on",
        name: "Reddit",
        icon: "fab fa-reddit-alien",
        url: "https://reddit.com/submit?url={url}&title={title}",
      },
      {
        id: "tumblr",
        enabled: tumblr === "on",
        name: "Tumblr",
        icon: "fab fa-tumblr",
        url:
          "https://www.tumblr.com/share/link?url={url}&name={title}&description={description}",
      },
      {
        id: "whatsapp",
        enabled: whatsapp === "on",
        name: "WhatsApp",
        icon: "fab fa-whatsapp",
        url: "https://api.whatsapp.com/send?text={title}%20{url}",
      },
      {
        id: "telegram",
        enabled: telegram === "on",
        name: "Telegram",
        icon: "fab fa-telegram-plane",
        url: "https://t.me/share/url?url={url}&text={title}",
      },
      {
        id: "viber",
        enabled: viber === "on",
        name: "Viber",
        icon: "fab fa-viber",
        url: "viber://forward?text={title}%20{url}",
      },
      {
        id: "skype",
        enabled: skype === "on",
        name: "Skype",
        icon: "fab fa-skype",
        url: "https://web.skype.com/share?url={url}&text={title}",
      },
      {
        id: "messenger",
        enabled: messenger === "on",
        name: "Messenger",
        icon: "fab fa-facebook-messenger",
        url:
          "https://www.facebook.com/dialog/send?app_id=794927004237856&link={url}&redirect_uri={url}",
      },
      {
        id: "vk",
        enabled: vk === "on",
        name: "VK",
        icon: "fab fa-vk",
        url:
          "https://vk.com/share.php?url={url}&title={title}&description={description}&image={image}",
      },
      {
        id: "xing",
        enabled: xing === "on",
        name: "Xing",
        icon: "fab fa-xing",
        url: "https://www.xing.com/app/user?op=share&url={url}",
      },
      {
        id: "email",
        enabled: email === "on",
        name: "Email",
        icon: "fas fa-envelope",
        url: "mailto:?subject={title}&body={description}%20{url}",
      },
      {
        id: "print",
        enabled: print === "on",
        name: "Print",
        icon: "fas fa-print",
        url: "#",
      },
    ];

    // Generate CSS classes
    const containerClasses = [
      "owl-social-share-buttons",
      `style-${button_style || "filled"}`,
      `shape-${button_shape || "rounded"}`,
      `size-${button_size || "medium"}`,
      `layout-${button_layout || "horizontal"}`,
      `hover-${hover_animation || "grow"}`,
      alignment ? `et_pb_text_align_${alignment}` : "et_pb_text_align_left",
      show_label === "on" ? "show-label" : "",
      show_count === "on" ? "show-count" : "",
      use_original_colors === "on" ? "original-colors" : "custom-colors",
      custom_css_class || ""
    ]
      .filter(Boolean)
      .join(" ");

    // Determine the URL, title, description, and image to share
    // For the Visual Builder, we'll use sample values or custom values if provided
    const pageUrl =
      custom_url || window.location.href || "https://example.com/sample-page";
    const pageTitle = custom_title || document.title || "Sample Page Title";
    const pageDescription =
      custom_description ||
      "This is a sample description for testing the social sharing module.";
    const pageImage = custom_image || ""; // Empty if no custom image is provided

    // HTML attributes for links
    const linkAttrs = {};
    if (open_in_new_tab === "on") {
      linkAttrs.target = "_blank";
    }
    if (add_rel_nofollow === "on") {
      linkAttrs.rel = "nofollow";
    }

    // Inline styles
    const buttonStyle = {
      marginRight: spacing,
      marginBottom: spacing,
    };

    const iconStyle = {
      fontSize: icon_font_size,
    };

    const labelStyle =
      show_label === "on"
        ? {
            fontSize: label_font_size,
          }
        : {};

    // Custom colors inline styles
    let customStyles = {};
    if (use_original_colors !== "on") {
      if (button_style === "filled") {
        customStyles = {
          backgroundColor: custom_color,
          color: custom_text_color,
        };
      } else if (button_style === "outlined") {
        customStyles = {
          borderColor: custom_color,
          color: custom_color,
          backgroundColor: "transparent",
        };
      } else if (button_style === "minimal") {
        customStyles = {
          color: custom_color,
          backgroundColor: "transparent",
        };
      }
    }

    return (
      <div className={containerClasses}>
        {/* Add title if enabled */}
        {show_title === "on" && title && (
          <h3 className="owl-social-share-title">{title}</h3>
        )}

        {/* Buttons container */}
        <div className="owl-social-share-buttons-container">
          {/* Generate buttons for enabled networks */}
          {networks.map((network) => {
            if (network.enabled) {
              // Replace placeholders in URL
              const shareUrl = network.url
                .replace("{url}", encodeURIComponent(pageUrl))
                .replace("{title}", encodeURIComponent(pageTitle))
                .replace("{description}", encodeURIComponent(pageDescription))
                .replace("{image}", encodeURIComponent(pageImage));

              return (
                <a
                  key={network.id}
                  href={shareUrl}
                  className={`owl-social-share-button owl-social-share-${network.id}`}
                  style={{ ...buttonStyle, ...customStyles }}
                  {...linkAttrs}
                >
                  <i
                    className={network.icon}
                    style={iconStyle}
                    aria-hidden="true"
                  ></i>

                  {show_label === "on" && (
                    <span style={labelStyle}>{network.name}</span>
                  )}

                  {show_count === "on" && (
                    <span className="owl-social-share-count">
                      {this.state.shareCounts[network.id] || 0}
                    </span>
                  )}
                </a>
              );
            }
            return null;
          })}
        </div>
      </div>
    );
  }
}

export default OwlSocialShareButton;
