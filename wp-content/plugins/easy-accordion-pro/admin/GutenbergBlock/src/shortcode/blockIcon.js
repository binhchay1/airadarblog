import { escapeAttribute } from "@wordpress/escape-html";
const el = wp.element.createElement;
const icons = {};
icons.speapIcon = el("img", {
  src: escapeAttribute(
    sp_easy_accordion_pro.url +
      "admin/GutenbergBlock/assets/easy-accordion-icon.svg"
  ),
});
export default icons;