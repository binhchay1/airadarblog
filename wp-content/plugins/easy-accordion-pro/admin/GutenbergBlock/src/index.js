import icons from "./shortcode/blockIcon";
import DynamicShortcodeInput from "./shortcode/dynamicShortcode";
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";
import { PanelBody, PanelRow } from "@wordpress/components";
import { Fragment, createElement } from "@wordpress/element";
import { escapeAttribute, escapeHTML } from "@wordpress/escape-html";
import { InspectorControls } from '@wordpress/block-editor';
const ServerSideRender = wp.serverSideRender;
const el = createElement;

/**
 * Register: Easy Accordion Pro Gutenberg Block.
 */
registerBlockType("sp-easy-accordion-pro/shortcode", {
  title: escapeHTML(__("Easy Accordion Pro", "easy-accordion-pro")),
  description: escapeHTML(__(
    "Use Easy Accordion to insert an accordion shortcode in your page.",
    "easy-accordion-pro"
  )),
  icon: icons.speapIcon,
  category: "common",
  supports: {
    html: true,
  },
  edit: (props) => {
    const { attributes, setAttributes } = props;
    var shortCodeList = sp_easy_accordion_pro.shortCodeList;

    let scriptLoad = (shortcodeId) => {
      let speapBlockLoaded = false;
      let speapBlockLoadedInterval = setInterval(function () {
        let uniqId = jQuery("#sp-ea-" + shortcodeId).parents().attr('id');
        if (document.getElementById(uniqId)) {
          //Actual functions goes here
          jQuery.getScript(sp_easy_accordion_pro.loadScript);
          jQuery.getScript(sp_easy_accordion_pro.loadPaginationScript);
          speapBlockLoaded = true;
          uniqId = '';
        }
        if (speapBlockLoaded) {
          clearInterval(speapBlockLoadedInterval);
        }
        if (0 == shortcodeId) {
          clearInterval(speapBlockLoadedInterval);
        }
      }, 10);
    }

    let updateShortcode = (updateShortcode) => {
      setAttributes({ shortcode: escapeAttribute(updateShortcode.target.value) });
    }

    let shortcodeUpdate = (e) => {
      updateShortcode(e);
      let shortcodeId = escapeAttribute(e.target.value);
      scriptLoad(shortcodeId);
    }

    document.addEventListener('readystatechange', event => {
      if (event.target.readyState === "complete") {
        let shortcodeId = escapeAttribute(attributes.shortcode);
        scriptLoad(shortcodeId);
      }
    });

    if (attributes.preview) {
      return (
        el('div', null,
          el('img', { src: escapeAttribute(sp_easy_accordion_pro.url + "admin/GutenbergBlock/assets/easy-accordion-preview.svg") })
        )
      )
    }

    if (shortCodeList.length === 0) {
      return (
        <Fragment>
          {el(
            "div",
            {
              className:
                "components-placeholder components-placeholder is-large",
            },
            el(
              "div",
              { className: "components-placeholder__label" },
              el("img", {
                className: "block-editor-block-icon",
                src: escapeAttribute(
                  sp_easy_accordion_pro.url +
                  "admin/GutenbergBlock/assets/easy-accordion-icon.svg"
                ),
              }),
              escapeHTML(__("Easy Accordion Pro", "easy-accordion-pro"))
            ),
            el(
              "div",
              { className: "components-placeholder__instructions" },
              escapeHTML(__("No shortcode found. ", "easy-accordion-pro")),
              el(
                "a",
                { href: escapeAttribute(sp_easy_accordion_pro.link) },
                escapeHTML(__("Create a shortcode now!", "easy-accordion-pro"))
              )
            )
          )}
        </Fragment>
      );
    }

    if (!attributes.shortcode || attributes.shortcode == 0) {
      return (
        <Fragment>
          <InspectorControls>
            <PanelBody title="Select a shortcode">
              <PanelRow>
                <DynamicShortcodeInput
                  attributes={attributes}
                  shortCodeList={shortCodeList}
                  shortcodeUpdate={shortcodeUpdate}
                />
              </PanelRow>
            </PanelBody>
          </InspectorControls>
          {el(
            "div",
            {
              className:
                "components-placeholder components-placeholder is-large",
            },
            el(
              "div",
              { className: "components-placeholder__label" },
              el("img", {
                className: "block-editor-block-icon",
                src: escapeAttribute(
                  sp_easy_accordion_pro.url +
                  "admin/GutenbergBlock/assets/easy-accordion-icon.svg"
                ),
              }),
              escapeHTML(__("Easy Accordion Pro", "easy-accordion-pro"))
            ),
            el(
              "div",
              { className: "components-placeholder__instructions" },
              escapeHTML(__("Select a shortcode", "easy-accordion-pro"))
            ),
            <DynamicShortcodeInput
              attributes={attributes}
              shortCodeList={shortCodeList}
              shortcodeUpdate={shortcodeUpdate}
            />
          )}
        </Fragment>
      );
    }

    return (
      <Fragment>
        <InspectorControls>
          <PanelBody title="Select a shortcode">
            <PanelRow>
              <DynamicShortcodeInput
                attributes={attributes}
                shortCodeList={shortCodeList}
                shortcodeUpdate={shortcodeUpdate}
              />
            </PanelRow>
          </PanelBody>
        </InspectorControls>
        <ServerSideRender block="sp-easy-accordion-pro/shortcode" attributes={attributes} />
      </Fragment>
    );
  },
  save() {
    // Rendering in PHP
    return null;
  },
});
