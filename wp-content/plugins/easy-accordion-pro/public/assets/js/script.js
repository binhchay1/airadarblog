; (function ($) {
	// Check video format.
	function isVideo(url) {
		var regex = /^(https?:\/\/)?((www\.)?youtube\.com|vimeo\.com|dailymotion\.com|wistia\.com|hubspot\.com|sproutvideo\.com|hippovideo\.io|brightcove\.com|spotlightr\.com|vidyard\.com)\/.+$/i;
		return regex.test(url);
	}
	$(document).find('.sp-easy-accordion').each(function () {
		var accordion_id = $(this).attr('id'),
			_this = $(this),
			ex_icon = _this.data('ex-icon'),
			keep_accordion = _this.data('keep-accordion'),
			col_icon = _this.data('col-icon'),
			ea_active = _this.data('ea-active'),
			ea_mode = _this.data('ea-mode'),
			multiColumn = _this.data('ea-multi-column'),
			preloader = _this.data('preloader'),
			autoplaytime = _this.data('autoplaytime'),
			autoclose = _this.data('autoclose'),
			expand_collapse = _this.data('expand'),
			scroll_active_item = _this.data('scroll-active-item'),
			offset_to_scroll = _this.data('offset-to-scroll');
		var eap_collapse_button_id = $(this).parents('.sp-eap-container').attr('id');
		var multiColumnAccordion = multiColumn === ' ea-multi-column' ? '.eap-multi-items-container >' : '';
		if ( ' ea-multi-column' === multiColumn && 'ea-auto' === ea_active ){
			ea_active = 'ea-hover';
		}

		$(document).ready(function () {
			var collapseLink = $("#" + eap_collapse_button_id + " .eap_faq_collapse_button a"),
				collapseText = $(collapseLink).parent('.eap_faq_collapse_button').data('collapse-text'),
				expandText = $(collapseLink).parent('.eap_faq_collapse_button').data('expand-text'),
				numPanelOpen = $("#" + eap_collapse_button_id + '> .ea-expand').length;

			if (numPanelOpen > 1) {
				$(collapseLink).html(`${collapseText} <span><i class="fa fa-angle-down"></i></span> <span><i class="fa fa-angle-up"></i></span>`);
			} else {
				$(collapseLink).addClass("active");
				$(collapseLink).html(`${expandText} <span><i class="fa fa-angle-down"></i></span> <span><i class="fa fa-angle-up"></i></span>`);
			}
		});

		if (!$('body').attr('notLoadAfterAjaxRequest')) {
			// Collapse/Expand button.
			$("#" + eap_collapse_button_id + " .eap_faq_collapse_button > a").on("click", function (e) {
				e.preventDefault();
				var numPanelOpen = $("#" + accordion_id + '> ' + multiColumnAccordion + ' .ea-expand').length;
				numPanelItem = $("#" + accordion_id + '> .ea-card').length,
					collapseText = $(this).parent('.eap_faq_collapse_button').data('collapse-text'),
					expandText = $(this).parent('.eap_faq_collapse_button').data('expand-text');
				if (numPanelOpen == 0 || numPanelOpen < numPanelItem) {
					$(this).addClass("active");
				}
				if ($(this).hasClass('active')) {
					$(this).html(`${collapseText} <span><i class="fa fa-angle-down"></i></span> <span><i class="fa fa-angle-up"></i></span>`);
					$("#" + accordion_id + " > " + multiColumnAccordion + " .ea-card > .sp-collapse").spcollapse("show");
					$(this).removeClass("active");
				} else {
					$(this).addClass("active");
					$(this).html(`${expandText} <span><i class="fa fa-angle-down"></i></span> <span><i class="fa fa-angle-up"></i></span>`);
					$("#" + accordion_id + " > " + multiColumnAccordion + " .ea-card > .sp-collapse").spcollapse("hide");
				}
			})
		}

		function activeEvents() {
			$("#" + accordion_id + " > .ea-card > .sp-collapse").on("hide.bs.spcollapse", function (e) {
				$(this).parent(".ea-card").removeClass("ea-expand");
				$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(col_icon).removeClass(ex_icon);
				e.stopPropagation();
			});
			$("#" + accordion_id + " > .ea-card > .sp-collapse").on("show.bs.spcollapse", function (e) {
				$(this).parent(".ea-card").addClass("ea-expand");
				$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(ex_icon).removeClass(col_icon);
				e.stopPropagation();
			});
			if (ea_mode === 'vertical') {
				if (ea_active === 'ea-click') {
					$("#" + accordion_id).each(function () {
						$("#" + accordion_id + " > .ea-card > .ea-header").on("click", function () {
							$("#" + accordion_id + " > .ea-card > .sp-collapse").on("hide.bs.spcollapse", function (e) {
								$(this).parent(".ea-card").removeClass("ea-expand");
								$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(col_icon).removeClass(ex_icon);
								e.stopPropagation();
							})
							$("#" + accordion_id + " > .ea-card > .sp-collapse").on("show.bs.spcollapse", function (e) {
								$(this).parent(".ea-card").addClass("ea-expand");
								$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(ex_icon).removeClass(col_icon);
								e.stopPropagation();
							})
						});
					});
				};
				if (ea_active === 'ea-auto') {

					$("#" + accordion_id).each(function () {
						$("#" + accordion_id + " > .ea-card > .ea-header").on("click", function () {
							$("#" + accordion_id + " > .ea-card > .sp-collapse").on("hide.bs.spcollapse", function (e) {
								$(this).parent(".ea-card").removeClass("ea-expand");
								$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(col_icon).removeClass(ex_icon);
								e.stopPropagation();
							})
							$("#" + accordion_id + " > .ea-card > .sp-collapse").on("show.bs.spcollapse", function (e) {
								$(this).parent(".ea-card").addClass("ea-expand");
								$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(ex_icon).removeClass(col_icon);
								e.stopPropagation();
							})
						});
					});

					function ea_autoplay() {
						var nextItem = $("#" + accordion_id + " > .ea-card.ea-expand").next();
						if (expand_collapse) {
							$("#" + accordion_id + " > .ea-card > .sp-collapse").spcollapse("hide");
						}
						if (!nextItem.length) {
							$("#" + accordion_id + " > .ea-card .ea-header a")[0].click();
						}
						$(nextItem).find('.sp-collapse').spcollapse("show");
					}
					if (!$('body').attr('notLoadAfterAjaxRequest')) {
						var interval = setInterval(ea_autoplay, autoplaytime); // Replace 3000 for delay between each slide.
						$("#" + accordion_id + ".sp-easy-accordion").hover(function () {
							clearInterval(interval);
						}, function () {
							interval = setInterval(ea_autoplay, autoplaytime); // Replace 3000 for delay between each slide.
						});
					}
				}

				if (ea_active === 'ea-hover') {
					if (autoclose == '1') {
						$("#" + accordion_id + " > .ea-card")
							.on("mouseenter", function () {
								$(this).children(".sp-collapse").spcollapse("show");
							})
							.on("mouseleave", function () {
								$(this).children(".sp-collapse").spcollapse("hide");
							});
					} else {
						$("#" + accordion_id + " > .ea-card").on('mouseover', function () {
							$(this).children(".sp-collapse").spcollapse("show");
						});
					}
					$("#" + accordion_id + " > .ea-card > .sp-collapse").on("hide.bs.spcollapse", function (e) {
						$(this).parent(".ea-card").removeClass("ea-expand");
						$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(col_icon).removeClass(ex_icon);
						e.stopPropagation();
					})
					$("#" + accordion_id + " > .ea-card > .sp-collapse").on("show.bs.spcollapse", function (e) {
						$(this).parent(".ea-card").addClass("ea-expand");
						$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(ex_icon).removeClass(col_icon);
						e.stopPropagation();
					})
				};

				// Scroll to active item scripts.
				if (scroll_active_item) {
					$("#" + accordion_id + ' .sp-collapse').on('show.bs.spcollapse', function (e) {
						var $panel = $(this).closest('.ea-card');
						setTimeout(function (e) {
							$('html,body').animate({
								scrollTop: $panel.offset().top - offset_to_scroll
							}, 500);
						}, 500)
					});
				}
			} else if (ea_mode === 'horizontal') {
				var sp_selector = $("#" + accordion_id + ".sp-horizontal-accordion > .single-horizontal:not(.ea-expand)");
				// Horizontal scrollbar scripts.
				var singleItemWidth = sp_selector.outerWidth();
				var horizontalItemsWidth = sp_selector.length * (singleItemWidth + parseInt(sp_selector.css("margin-right"))) + 400;
				var wrapperWidth = $("#" + accordion_id + ".sp-horizontal-accordion").parents('.sp-eap-container').outerWidth();
				var scrollableWidth = horizontalItemsWidth > wrapperWidth ? horizontalItemsWidth : wrapperWidth;
				$("#" + accordion_id + ".sp-horizontal-accordion").css("width", scrollableWidth);
				if (horizontalItemsWidth > wrapperWidth) {
					$("#" + accordion_id + ".sp-horizontal-accordion").wrap("<div class='sp-horizontal-accordion-wrapper'></div>");
				}
				var count = sp_selector.length,
					itemMargin = parseInt(sp_selector.css("margin-right")) * count,
					item_width = (sp_selector.outerWidth() * count) + itemMargin,
					containerWidth = $("#" + accordion_id + ".sp-horizontal-accordion").outerWidth(),
					activeWidth = containerWidth - item_width,
					activeWidth = activeWidth >= 400 ? activeWidth : 400,
					activeItem = $("#" + accordion_id + ".sp-horizontal-accordion > .single-horizontal.ea-expand");
				activeItem.addClass("active").css("width", activeWidth);
				if (ea_active === 'ea-hover') {
					$("#" + accordion_id + " > .ea-card > .ea-header").hover(function (e) {
						$(this).siblings(".sp-collapse").spcollapse("toggle");
						e.stopPropagation();
					});
				} else {
					$("#" + accordion_id + " > .ea-card > .ea-header").on('click', function (e) {
						$(this).siblings(".sp-collapse").spcollapse("toggle");
						e.stopPropagation();
					});
				}
				$("#" + accordion_id + " > .ea-card > .sp-collapse").on("show.bs.spcollapse", function (e) {
					$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(ex_icon).removeClass(col_icon);
					$(this).parent(".ea-card").addClass("ea-expand").css("width", activeWidth);
					e.stopPropagation();
				});
				$("#" + accordion_id + " > .ea-card > .sp-collapse").on("hide.bs.spcollapse", function (e) {
					var contentWidth = $(this).outerWidth() >= 400 ? $(this).outerWidth() : 400;
					$(this).parent(".ea-card").removeClass("ea-expand").css("width", "");
					$(this).css("width", contentWidth);
					$(this).siblings(".ea-header").find(".ea-expand-icon").addClass(col_icon).removeClass(ex_icon);
					e.stopPropagation();
				});
				if (ea_active === 'ea-auto') {
					function ea_autoplay() {
						var nextItem = $("#" + accordion_id + " > .ea-card.ea-expand").next();
						if (!nextItem.length) {
							$("#" + accordion_id + " > .ea-card > .ea-header a")[0].click();
						}
						$(nextItem).find('.ea-header a').trigger('click');
					}
					if (!$('body').attr('notLoadAfterAjaxRequest')) {
						var interval = setInterval(ea_autoplay, autoplaytime); // Replace 3000 for delay between each slide.
						$("#" + accordion_id + " > .ea-card").hover(function () {
							clearInterval(interval);
						}, function () {
							interval = setInterval(ea_autoplay, autoplaytime); // Replace 3000 for delay between each slide.
						});
					}
				}
			}
			if ($('.ea-youtube-wrapper').length < 1) {
				$(".ea-body object,.ea-body embed").wrap("<div class='ea-youtube-wrapper'></div>");
			}
			// Fix of  Twenty twenty theme iframe conflict issue.
			setTimeout(function () {
				$('.ea-body iframe[style*="width: 0px"]').css({ 'width': '', 'height': '' });
			}, 300);
			// Iframe wrapper 
			$('#' + accordion_id + ' iframe:not(.ea-iframe,.skip,[src*="omny.fm/"])').each(function (i) {
				let src = $(this).attr('src');
				// Check if the iframe source is video or not.
				if (isVideo(src)) {
					let max_width = $(this).attr('width') > 100 ? 'max-width:' + $(this).attr('width') + 'px' : '';
					$(this).addClass('ea-iframe').wrap("<div class='ea-iframe-container " + accordion_id + "_" + i + " '></div>");
					if (max_width) {
						$(this).parent('.ea-iframe-container').wrap("<div style='" + max_width + ";width: 100%;display: inline-block;'></div>");
					}
				}
			});
		}
		activeEvents();

		var preloader_id = $('.accordion-preloader').attr('id');
		if (preloader === 1) {
			$("#" + accordion_id).each(function () {
				$('#' + preloader_id).animate({
					opacity: 0,
				}, 500).remove();
				$('#' + accordion_id).find('.ea-card').animate({
					opacity: 1
				}, 500);
			});
		}


		$("a[href*='#collapse']").on('click', function () {
			var theTarget = $(this).prop("hash");
			$(theTarget + '.spcollapse').parents("[id*='collapse']").spcollapse('show');
			$(theTarget + '.spcollapse').spcollapse('show');
		});

		$(".eap_title_to_slug .sp-ea-single a.collapsed").on('click', function (e) {
			e.preventDefault();
			var _this = $(this);
			var theTarget = _this.data("title");
			setTimeout(() => {
				if (_this.hasClass('collapsed')) {
					history.pushState("", document.title, window.location.pathname + window.location.search);
				} else {
					window.location.hash = theTarget;
				}
			}, 600);
		});
		$(function () {
			// check if there is a hash in the url
			if (window.location.hash != '') {
				//  $('.spcollapse').removeClass('show').siblings(".ea-header").find('.ea-expand-icon').removeClass(ex_icon).addClass(col_icon);
				// show the panel based on the hash now.
				if (window.location.hash.indexOf('efaq') != -1) {
					$('[data-title=' + window.location.hash.substring(1) + ']').parents(".ea-header").siblings('.sp-collapse').spcollapse('show');
				}
				$(window.location.hash + '.spcollapse').parents("[id*='collapse']").spcollapse('show');
				$(window.location.hash + '.spcollapse').spcollapse('show');
			}

		});

		// FAQ search script.
		var searchTerm, panelContainerId;
		// Create a new contains that is case insensitive
		$.expr.pseudos.containsCaseInsensitive = function (n, i, m) {
			return $(n).text().toUpperCase().indexOf(m[1].toUpperCase()) >= 0;
		};
		var Load_more = _this.parents('.sp-eap-container').find('.sp-eap-load-more'),
			button_attr = Load_more.children('button'),
			total_accordion = button_attr.data('total-post');

		$('#eap_faq_search_bar_' + accordion_id).on('keyup', delay(function () {
			$(this).parents(".sp-eap-container").find('.ea-multi-column .sp-ea-single').css('opacity', '0');
			$(this).parents('.sp-eap-container').find(".ea-multi-column .eap-multi-items-container").contents().unwrap();
			searchTerm = $(this).val();
			var id = $(this).data('shortcode-id');
			var search_autocomplete = $(this).data('autocomplete');
			var container_id = 'sp-eap-accordion-section-' + id;
			$.ajax({
				type: 'POST',
				url: sp_eap_ajax_obj.ajax_url,
				nonce: sp_eap_ajax_obj.nonce,
				data: {
					action: 'sp_eap_ajax_load_search',
					nonce: sp_eap_ajax_obj.nonce,
					id: id,
					keyword: searchTerm,
				},
				success: function (response) {
					var $data = $(response);
					// Autocomplete suggestion code.
					if (search_autocomplete) {
						var optionTexts = [];
						$data.find('.ea-header').each(function (i, v) {
							JSON.stringify(v);
							optionTexts[i] = $(v).text().trim();
						});
						$.widget('ui.customAutocompleteWidget', $.ui.autocomplete, {
							renderItem: function (ul, item) {
								return $('<li>')
									.append($('<a>').html(decodeURI(item.label)))
									.appendTo(ul);
							}
						});

						$('#eap_faq_search_bar_' + accordion_id).customAutocompleteWidget({
							source: optionTexts,
							delay: 0,
							create: function () {
								$(this).customAutocompleteWidget('widget')
									.addClass('eap-autocomplete-wrapper')
									.css({
										'max-height': 500,
										'overflow-y': 'scroll',
										'overflow-x': 'hidden'
									});
							},
							select: function (event, ui) {
								$('#eap_faq_search_bar_' + accordion_id).val(ui.item.label).trigger('keyup');
								return false;
							}
						});
					}
					jQuery('#sp-ea-' + id).empty().html($data);
					$('#' + container_id).find('.sp-eap-load-more').html('');
					$('#' + container_id).find('.sp-eap-ajax-number-pagination').css({ display: "none" });
					setTimeout(function () {
						$('#' + container_id).find('.accordion-preloader').css({ display: "none" });
					}, 100);
					activeEvents();
					multiColumnAccordionWrapper();
					if (searchTerm == '') {
						$('#' + container_id).find('.sp-eap-load-more').html(button_attr.clone());
						$('#' + container_id).find('.sp-eap-ajax-number-pagination').css({ display: "block" });
						jQuery.getScript(sp_eap_ajax_pagi.loadPagiScript);
						$('#' + container_id).find('.accordion-preloader').css({ display: "none" });
					}
					$('#' + accordion_id).find('.ea-card').animate({
						opacity: 1
					}, 500);
					$(document).find('#sp-ea-' + id + ".sp-easy-accordion").removeHighlight().highlight(searchTerm);
				}
			});
		}, 500));


		function delay(callback, ms) {
			var timer = 0;
			return function () {
				var context = this, args = arguments;
				clearTimeout(timer);
				timer = setTimeout(function () {
					callback.apply(context, args);
				}, ms || 0);
			};
		}
		// FAQ search result highlighting script.
		jQuery.fn.highlight = function (pat) {
			function innerHighlight(node, pat) {
				var skip = 0;
				if (node.nodeType == 3) {
					var pos = node.data.toUpperCase().indexOf(pat);
					pos -= (node.data.substr(0, pos).toUpperCase().length - node.data.substr(0, pos).length);
					if (pos >= 0) {
						var spanTag = document.createElement('span');
						spanTag.className = 'eap-search-highlight';
						var middleBit = node.splitText(pos);
						var endBit = middleBit.splitText(pat.length);
						var middleClone = middleBit.cloneNode(true);
						spanTag.appendChild(middleClone);
						middleBit.parentNode.replaceChild(spanTag, middleBit);
						skip = 1;
					}
				}
				else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
					for (var i = 0; i < node.childNodes.length; ++i) {
						i += innerHighlight(node.childNodes[i], pat);
					}
				}
				return skip;
			}
			return this.length && pat && pat.length ? this.each(function () {
				innerHighlight(this, pat.toUpperCase());
			}) : this;
		};
		jQuery.fn.removeHighlight = function () {
			return this.find("span.eap-search-highlight").each(function () {
				this.parentNode.firstChild.nodeName;
				with (this.parentNode) {
					replaceChild(this.firstChild, this);
					normalize();
				}
			}).end();
		};

		// highlight matching word.
		$('#eap_faq_search_bar_' + accordion_id).on('keyup', function () {
			searchTerm = $(this).val();
			$("#" + accordion_id + ".sp-easy-accordion").removeHighlight().highlight(searchTerm);
		});

		// Multi Column Accordion scripts.
		function multiColumnAccordionWrapper() {
			const container = $("#" + accordion_id + ".sp-easy-accordion.ea-multi-column");
			// Divide items into two divs
			if (container.length > 0) {
				const items = container.children(".sp-ea-single");
				const halfLength = Math.ceil(items.length / 2);
				const div1 = $("<div>").addClass("eap-multi-items-container").appendTo(container);
				items.slice(0, halfLength).appendTo(div1);

				const div2 = $("<div>").addClass("eap-multi-items-container").appendTo(container);
				items.slice(halfLength).appendTo(div2);
				const checkPagination = container.parents('.sp-eap-container').find('.sp-eap-load-more');
				// Set the opacity of .sp-ea-single elements to 1
				container.find(".eap-multi-items-container .sp-ea-single").css('opacity', '1');
			}
		};
		multiColumnAccordionWrapper();

		// custom keep accordion.
		$(document).ready(function () {
			if (keep_accordion) {
				var active_col = keep_accordion;
				$("#" + accordion_id).find(".ea-expand-icon").addClass(col_icon).removeClass(ex_icon);
				if ($("#" + accordion_id).parents('.spcollapse').length > 0) {
					if ($("#" + accordion_id).parents('.spcollapse.show').length > 0) {
						$("#" + accordion_id + " > .ea-card:nth-child(" + active_col + "):not(.ea-expand) > .ea-header a").trigger('click');
					}
				} else {
					$("#" + accordion_id + " > .ea-card:nth-child(" + active_col + "):not(.ea-expand) > .ea-header a").trigger('click');
				}
			}
		})
	});

	if ($('body').find('.sp-easy-accordion').length > 0) {
		$('body').attr('notLoadAfterAjaxRequest', '1');
	}

})(jQuery);
