# Post Slider Gutenberg Block

## Description
The **Post Slider** is a custom Gutenberg block that displays a slideshow of posts from an external REST API source. This block allows users to configure options like auto-scroll, looping, dots navigation, and displaying post dates.
Note for Reviewer -  1. JSON struture should be same as give API file to fetch from other urls.
        2. Kept design minimal for now if need to add more design let me khow 

## Features
- Fetches posts dynamically from a JSON API.
- Displays a slider with images, titles, and optional dates.
- Support keyboard navigation
- In mobile , use can swipe with a thumb to move between the next and previous slides.
- Customizable options:
  - Auto-scroll
  - Infinite loop
  - Show/hide dots navigation
  - Show/hide post date
- Caching mechanism for optimized performance.

## Installation
1. Upload the plugin folder("Post-slider") to the `/wp-content/plugins/` directory Or download zip file (Post-slider.zip) and upload via upload a plugin from plugins in wp dashboard.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Insert the block in the Gutenberg editor by searching for **Post Slider**.

## Usage
1. Open the **Gutenberg Editor**.
2. Click on **Add Block (+)** and search for **Post Slider**.
3. Configure the block settings from the sidebar.
4. Publish or preview the post/page to see the slider in action.

## Block Attributes
| Attribute   | Type    | Default | Description |
|------------|--------|---------|-------------|
| `url`      | String | `https://wptavern.com/wp-json/wp/v2/posts` | The API endpoint to fetch posts from. |
| `autoScroll` | Boolean | `true` | Enables auto-scrolling for the slider. |
| `loop` | Boolean | `true` | Enables infinite looping of slides. |
| `showDots` | Boolean | `true` | Shows dot indicators for navigation. |
| `showDate` | Boolean | `true` | Displays the post publish date. |

## Scripts & Styles
### Editor & Frontend Scripts:
- **`build/index.js`** – Main JavaScript file for registering the block.
- **`src/assets/main.js`** – Handles the slider functionality.

### Editor & Frontend Styles:
- **`src/assets/style.css`** – Styles for both editor and frontend.

## Development
### Prerequisites
Ensure you have Node.js and npm installed before proceeding.

### Build the Project
Run the following commands in the plugin directory:
```sh
npm install
npm run build
```

For development mode:
```sh
npm run start
```

### PHP Hooks & Functions
- **`post_slider_render($attributes)`** – Handles the rendering of the block.
- **`post_slider_register_block()`** – Registers the block, scripts, and styles.

## Changelog
### Version 1.0
- Initial release with full functionality.

## Author
Developed by **Pranit Dugad**.

## License
This plugin is licensed under the **GPL-2.0+**.



Made By Pranit Dugad for rtCamp Assignment
