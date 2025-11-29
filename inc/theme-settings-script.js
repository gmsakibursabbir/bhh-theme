document.addEventListener("DOMContentLoaded", function () {
  const settings = window.bhThemeSettings || {};
  const container = document.getElementById("bh-fields-container");
  const generalContainer = document.getElementById(
    "bh-general-fields-container"
  );
  const pageSelector = document.getElementById("bh-page-selector");
  const settingsInput = document.getElementById("bh_settings_input");
  const codeOutput = document.getElementById("bh-code-output");

  // State
  let currentSettings =
    Array.isArray(settings) && settings.length === 0 ? {} : settings || {};
  let activeField = null;
  let codeViewMode = "all"; // 'all' or 'single'
  const activeTabInput = document.getElementById("bh_active_tab");
  let currentTab = activeTabInput ? activeTabInput.value : "general";

  // --- Tab Handling ---
  document.querySelectorAll(".nav-tab").forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault();

      // Update Tabs
      document
        .querySelectorAll(".nav-tab")
        .forEach((t) => t.classList.remove("nav-tab-active"));
      tab.classList.add("nav-tab-active");

      // Update Content
      const target = tab.dataset.tab;
      currentTab = target;

      // Update Hidden Input
      if (activeTabInput) {
        activeTabInput.value = target;
      }

      document
        .querySelectorAll(".bh-tab-content")
        .forEach((c) => c.classList.remove("active"));
      document.getElementById(`tab-${target}`).classList.add("active");

      // Update Code Preview
      updateCodePreview();
    });
  });

  // --- Code View Tabs ---
  document.querySelectorAll(".bh-code-tabs button").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      document
        .querySelectorAll(".bh-code-tabs button")
        .forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");
      codeViewMode = btn.dataset.view;
      updateCodePreview();
    });
  });

  // --- Rendering ---

  function renderFields(contextId, containerEl) {
    containerEl.innerHTML = "";
    if (!contextId) return;

    const fields = currentSettings[contextId] || [];

    if (fields.length === 0) {
      if (contextId === "general") {
        containerEl.innerHTML =
          '<div class="bh-empty-state"><p>No fields configured.</p></div>';
      } else {
        containerEl.innerHTML =
          '<div class="bh-empty-state"><p>👆 Click "Add Field" to add content fields.</p></div>';
      }
      updateCodePreview();
      return;
    }

    fields.forEach((field, index) => {
      containerEl.insertAdjacentHTML(
        "beforeend",
        renderField(field, index, contextId)
      );
    });

    updateCodePreview();
  }

  function renderField(field, index, contextId) {
    let valueInput = "";
    const isSelected =
      activeField &&
      activeField.index === index &&
      activeField.context === contextId;
    const selectedClass = isSelected ? "bh-field-selected" : "";

    // Render value input based on field type
    switch (field.type) {
      case "image":
        valueInput = `
          <div class="bh-field-value-container">
            <div class="bh-image-upload-wrapper">
              <input type="text" class="bh-field-value" value="${
                field.value || ""
              }" placeholder="Image URL">
              <button type="button" class="button upload-image-btn">Upload Image</button>
              ${
                field.value
                  ? `<img src="${field.value}" class="bh-image-preview" alt="Preview">`
                  : ""
              }
            </div>
          </div>
        `;
        break;

      case "textarea":
        valueInput = `
          <div class="bh-field-value-container">
            <textarea class="bh-field-value" rows="3" placeholder="Content">${
              field.value || ""
            }</textarea>
          </div>
        `;
        break;

      case "select":
        const options = field.options || [
          { value: "option1", label: "Option 1" },
          { value: "option2", label: "Option 2" },
        ];
        const selectOptions = options
          .map(
            (opt) =>
              `<option value="${opt.value}" ${
                field.value === opt.value ? "selected" : ""
              }>${opt.label}</option>`
          )
          .join("");
        valueInput = `
          <div class="bh-field-value-container">
            <select class="bh-field-value bh-select-field">
              <option value="">-- Select --</option>
              ${selectOptions}
            </select>
            <button type="button" class="button button-small bh-edit-options" data-field-index="${index}">Edit Options</button>
          </div>
        `;
        break;

      case "toggle":
        const checked =
          field.value === true || field.value === "true" || field.value === "1";
        valueInput = `
          <div class="bh-field-value-container">
            <label class="bh-toggle-switch">
              <input type="checkbox" class="bh-field-value bh-toggle-input" ${
                checked ? "checked" : ""
              } value="${checked}">
              <span class="bh-toggle-slider"></span>
              <span class="bh-toggle-label">${
                checked ? "Enabled" : "Disabled"
              }</span>
            </label>
          </div>
        `;
        break;

      case "color":
        valueInput = `
          <div class="bh-field-value-container">
            <div class="bh-color-picker-wrapper">
              <input type="text" class="bh-field-value bh-color-input" value="${
                field.value || "#2271b1"
              }" placeholder="#2271b1">
              <input type="color" class="bh-color-picker" value="${
                field.value || "#2271b1"
              }">
              <span class="bh-color-preview" style="background-color: ${
                field.value || "#2271b1"
              }"></span>
            </div>
          </div>
        `;
        break;

      case "number":
        const min = field.min || 0;
        const max = field.max || 100;
        const step = field.step || 1;
        valueInput = `
          <div class="bh-field-value-container">
            <input type="number" class="bh-field-value bh-number-input" value="${
              field.value || min
            }" 
                   min="${min}" max="${max}" step="${step}" placeholder="${min}">
          </div>
        `;
        break;

      case "url":
        valueInput = `
          <div class="bh-field-value-container">
            <input type="url" class="bh-field-value" value="${
              field.value || ""
            }" placeholder="https://example.com">
          </div>
        `;
        break;

      default: // text
        valueInput = `
          <div class="bh-field-value-container">
            <input type="text" class="bh-field-value" value="${
              field.value || ""
            }" placeholder="Content">
          </div>
        `;
    }

    const isGeneral = contextId === "general";

    // For General Settings, we want a simpler UI (Fixed fields)
    let controlsHtml = "";
    if (!isGeneral) {
      controlsHtml = `
            <div class="bh-field-controls">
                <span class="bh-drag-handle dashicons dashicons-menu" title="Drag to reorder" style="cursor: move; color: #ccc;"></span>
                <input type="text" class="bh-field-name" value="${
                  field.name || ""
                }" placeholder="Field Name (ID)" aria-label="Field Name">
                <input type="text" class="bh-field-label" value="${
                  field.label || ""
                }" placeholder="Label" aria-label="Field Label">
                <select class="bh-field-type" aria-label="Field Type">
                    <option value="text" ${
                      field.type === "text" ? "selected" : ""
                    }>Text</option>
                    <option value="textarea" ${
                      field.type === "textarea" ? "selected" : ""
                    }>Textarea</option>
                    <option value="select" ${
                      field.type === "select" ? "selected" : ""
                    }>Select</option>
                    <option value="toggle" ${
                      field.type === "toggle" ? "selected" : ""
                    }>Toggle</option>
                    <option value="color" ${
                      field.type === "color" ? "selected" : ""
                    }>Color</option>
                    <option value="number" ${
                      field.type === "number" ? "selected" : ""
                    }>Number</option>
                    <option value="image" ${
                      field.type === "image" ? "selected" : ""
                    }>Image</option>
                    <option value="url" ${
                      field.type === "url" ? "selected" : ""
                    }>URL</option>
                </select>
                <button type="button" class="button button-small duplicate-field" title="Duplicate Field" aria-label="Duplicate field">
                    <span class="dashicons dashicons-admin-page"></span>
                </button>
                <button type="button" class="button button-small remove-field" title="Remove Field" aria-label="Remove field">
                    <span class="dashicons dashicons-trash"></span>
                </button>
            </div>
        `;
    } else {
      // Minimal header for General fields
      controlsHtml = `
            <div class="bh-field-controls" style="background: #fff; border-bottom: none; padding-bottom: 0;">
                <strong style="font-size: 14px;">${field.label}</strong>
                <input type="hidden" class="bh-field-name" value="${field.name}">
                <input type="hidden" class="bh-field-label" value="${field.label}">
                <input type="hidden" class="bh-field-type" value="${field.type}">
            </div>
        `;
    }

    return `
            <div class="bh-field-item ${selectedClass}" draggable="${!isGeneral}" data-index="${index}" data-context="${contextId}" role="group" aria-label="${
              field.label || "Field"
            }">
                ${controlsHtml}
                ${valueInput}
            </div>
        `;
  }

  function updateState() {
    // Helper to get field value based on type
    function getFieldValue(fieldEl) {
      const type = fieldEl.querySelector(".bh-field-type").value;
      const valueEl = fieldEl.querySelector(".bh-field-value");

      if (!valueEl) return "";

      switch (type) {
        case "toggle":
          return valueEl.checked ? "1" : "0";
        case "number":
          return valueEl.value || "0";
        case "color":
          return fieldEl.querySelector(".bh-color-input")?.value || "#2271b1";
        default:
          return valueEl.value || "";
      }
    }

    // Update General Fields
    const generalFields = [];
    if (generalContainer) {
      generalContainer.querySelectorAll(".bh-field-item").forEach((fieldEl) => {
        const field = {
          name: fieldEl.querySelector(".bh-field-name").value,
          label: fieldEl.querySelector(".bh-field-label").value,
          type: fieldEl.querySelector(".bh-field-type").value,
          value: getFieldValue(fieldEl),
        };

        // Store options for select fields
        if (field.type === "select") {
          const selectEl = fieldEl.querySelector(".bh-select-field");
          field.options = Array.from(selectEl.options)
            .filter((opt) => opt.value !== "")
            .map((opt) => ({ value: opt.value, label: opt.textContent }));
        }

        generalFields.push(field);
      });
      currentSettings["general"] = generalFields;
    }

    // Update Page Fields
    const pageId = pageSelector.value;
    if (pageId) {
      const fields = [];
      container.querySelectorAll(".bh-field-item").forEach((fieldEl) => {
        const field = {
          name: fieldEl.querySelector(".bh-field-name").value,
          label: fieldEl.querySelector(".bh-field-label").value,
          type: fieldEl.querySelector(".bh-field-type").value,
          value: getFieldValue(fieldEl),
        };

        // Store options for select fields
        if (field.type === "select") {
          const selectEl = fieldEl.querySelector(".bh-select-field");
          field.options = Array.from(selectEl.options)
            .filter((opt) => opt.value !== "")
            .map((opt) => ({ value: opt.value, label: opt.textContent }));
        }

        fields.push(field);
      });
      currentSettings[pageId] = fields;
    }

    settingsInput.value = JSON.stringify(currentSettings);
    updateCodePreview();
  }

  function updateCodePreview() {
    let contextId = currentTab === "general" ? "general" : pageSelector.value;

    if (!contextId || !currentSettings[contextId]) {
      codeOutput.value = "// Select a template or add fields to generate code.";
      return;
    }

    let code = `<?php\n// Get settings\n$settings = get_option('bh_theme_settings');\n$fields = isset($settings['${contextId}']) ? $settings['${contextId}'] : [];\n`;

    const fields = currentSettings[contextId];
    let fieldsToShow = fields;

    // Filter if showing single field
    if (
      codeViewMode === "single" &&
      activeField &&
      activeField.context === contextId
    ) {
      fieldsToShow = fields.filter((f, i) => i === parseInt(activeField.index));
      if (fieldsToShow.length === 0) {
        codeOutput.value = "// Select a field to view its code.";
        return;
      }
    }

    fieldsToShow.forEach((field) => {
      if (!field.name) return;
      code += `\n// --- Field: ${field.label} (${field.name}) ---\n`;

      // Helper function style (cleaner)
      code += `$val = '';\n`;
      code += `foreach ($fields as $f) {\n    if ($f['name'] === '${field.name}') {\n        $val = $f['value'];\n        break;\n    }\n}\n`;

      if (field.type === "image") {
        code += `if ($val) {\n`;
        code += `    echo esc_url($val);\n`;
        code += `}\n`;
      } else if (field.type === "url") {
        code += `if ($val) {\n`;
        code += `    echo esc_url($val);\n`;
        code += `}\n`;
      } else {
        code += `if ($val) {\n`;
        code += `    echo wp_kses_post($val);\n`;
        code += `}\n`;
      }
    });
    // syncFieldsFromDOM(); // REMOVED: Function does not exist
    // THEN: Serialize current settings to hidden input
    // settingsInput.value = JSON.stringify(currentSettings); // REMOVED: Already handled in updateState()
    // Update code preview
    // updateCodePreview(); // REMOVED: Infinite recursion
    code += `?>`;
    codeOutput.value = code;
  }

  // --- Form Submission Handler ---
  const settingsForm = document.getElementById("bh-settings-form");
  if (settingsForm) {
    settingsForm.addEventListener("submit", function (e) {
      // Make sure the latest state is serialized before submitting
      updateState();
    });
  }

  // --- Event Listeners ---

  // Page Selector
  pageSelector.addEventListener("change", (e) => {
    const contextId = e.target.value;

    // Update hidden input
    const activePageInput = document.getElementById("bh_active_page");
    if (activePageInput) {
      activePageInput.value = contextId;
    }

    renderFields(contextId, container);
    settingsInput.value = JSON.stringify(currentSettings);
  });

  // Add Field (Page)
  const addFieldBtn = document.getElementById("bh-add-field");
  if (addFieldBtn) {
    addFieldBtn.addEventListener("click", () => {
      const pageId = pageSelector.value;
      if (!pageId) {
        alert("Please select a template first.");
        return;
      }
      if (!currentSettings[pageId]) currentSettings[pageId] = [];
      currentSettings[pageId].push({
        name: "",
        label: "",
        type: "text",
        value: "",
      });
      renderFields(pageId, container);
      updateState();
    });
  }

  // Global Event Delegation
  document.body.addEventListener("click", (e) => {
    // Duplicate Field
    if (e.target.closest(".duplicate-field")) {
      const item = e.target.closest(".bh-field-item");
      const index = parseInt(item.dataset.index);
      const context = item.dataset.context;

      // Get the field data
      const fieldToDuplicate = currentSettings[context][index];

      // Create a copy of the field
      const duplicatedField = {
        ...fieldToDuplicate,
        name: fieldToDuplicate.name ? fieldToDuplicate.name + "_copy" : "",
        label: fieldToDuplicate.label ? fieldToDuplicate.label + " (Copy)" : "",
      };

      // Insert the duplicated field right after the original
      currentSettings[context].splice(index + 1, 0, duplicatedField);

      // Re-render
      if (context === "general") {
        renderFields("general", generalContainer);
      } else {
        renderFields(context, container);
      }
      updateState();
    }
    // Remove Field
    else if (e.target.closest(".remove-field")) {
      if (confirm("Are you sure you want to remove this field?")) {
        const item = e.target.closest(".bh-field-item");
        const index = item.dataset.index;
        const context = item.dataset.context;

        currentSettings[context].splice(index, 1);

        if (context === "general") {
          renderFields("general", generalContainer);
        } else {
          renderFields(context, container);
        }
        updateState();
      }
    }
    // Upload Image
    else if (e.target.classList.contains("upload-image-btn")) {
      e.preventDefault();
      const btn = e.target;
      const input = btn.previousElementSibling;

      const imageFrame = wp.media({
        title: "Select Image",
        multiple: false,
        library: { type: "image" },
      });

      imageFrame.on("select", function () {
        const selection = imageFrame.state().get("selection").first().toJSON();
        input.value = selection.url;
        updateState();

        // Re-render to show preview
        const item = btn.closest(".bh-field-item");
        const context = item.dataset.context;
        if (context === "general") {
          renderFields("general", generalContainer);
        } else {
          renderFields(context, container);
        }
      });

      imageFrame.open();
    }
    // Color Picker Sync
    else if (e.target.classList.contains("bh-color-picker")) {
      const colorInput = e.target.previousElementSibling;
      const colorPreview = e.target.nextElementSibling;
      colorInput.value = e.target.value;
      if (colorPreview) {
        colorPreview.style.backgroundColor = e.target.value;
      }
      updateState();
    }
    // Select Field (for code preview)
    else if (e.target.closest(".bh-field-item")) {
      const item = e.target.closest(".bh-field-item");

      // Don't trigger if clicking inputs/buttons
      if (
        e.target.tagName === "INPUT" ||
        e.target.tagName === "SELECT" ||
        e.target.tagName === "BUTTON" ||
        e.target.tagName === "TEXTAREA"
      ) {
        activeField = {
          index: item.dataset.index,
          context: item.dataset.context,
        };

        // Highlight in UI
        document
          .querySelectorAll(".bh-field-item")
          .forEach((el) => el.classList.remove("bh-field-selected"));
        item.classList.add("bh-field-selected");

        if (codeViewMode === "single") {
          updateCodePreview();
        }
        return;
      }

      activeField = {
        index: item.dataset.index,
        context: item.dataset.context,
      };

      document
        .querySelectorAll(".bh-field-item")
        .forEach((el) => el.classList.remove("bh-field-selected"));
      item.classList.add("bh-field-selected");

      if (codeViewMode === "single") {
        updateCodePreview();
      }
    }
  });

  // Input Changes
  document.body.addEventListener("input", (e) => {
    if (
      e.target.matches(
        ".bh-field-item input, .bh-field-item select, .bh-field-item textarea"
      )
    ) {
      updateState();

      // Auto-generate field name from label
      if (e.target.classList.contains("bh-field-label")) {
        const fieldItem = e.target.closest(".bh-field-item");
        const nameInput = fieldItem.querySelector(".bh-field-name");
        const labelValue = e.target.value;

        // Only auto-generate if name field is empty or looks auto-generated
        // (doesn't contain manually typed content)
        if (
          nameInput &&
          (!nameInput.value || nameInput.dataset.autoGenerated === "true")
        ) {
          // Convert label to slug: lowercase, replace spaces/special chars with underscores
          const generatedName = labelValue
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, "_") // Replace non-alphanumeric with underscore
            .replace(/^_+|_+$/g, ""); // Remove leading/trailing underscores

          nameInput.value = generatedName;
          nameInput.dataset.autoGenerated = "true";
          updateState();
        }
      }

      // Mark name field as manually edited if user types in it
      if (e.target.classList.contains("bh-field-name")) {
        e.target.dataset.autoGenerated = "false";
      }
    }
  });

  // Field Type Change
  document.body.addEventListener("change", (e) => {
    if (e.target.classList.contains("bh-field-type")) {
      const item = e.target.closest(".bh-field-item");
      const index = parseInt(item.dataset.index);
      const context = item.dataset.context;
      const newType = e.target.value;

      // Update settings
      currentSettings[context][index].type = newType;

      // Optional: Reset value on type change to avoid incompatible data
      // currentSettings[context][index].value = "";

      // Re-render
      if (context === "general") {
        renderFields("general", generalContainer);
      } else {
        renderFields(context, container);
      }
      updateState();
    }
  });

  // --- Drag and Drop ---
  let draggedItem = null;

  document.addEventListener("dragstart", (e) => {
    if (
      e.target.matches(".bh-field-item") &&
      e.target.getAttribute("draggable") === "true"
    ) {
      draggedItem = e.target;
      e.target.classList.add("bh-dragging");
      e.dataTransfer.effectAllowed = "move";
      e.dataTransfer.setData("text/html", e.target.outerHTML);
    }
  });

  document.addEventListener("dragend", (e) => {
    if (e.target.matches(".bh-field-item")) {
      e.target.classList.remove("bh-dragging");
      draggedItem = null;
      document.querySelectorAll(".bh-field-item").forEach((item) => {
        item.classList.remove("bh-drag-over-top");
        item.classList.remove("bh-drag-over-bottom");
      });
    }
  });

  document.addEventListener("dragover", (e) => {
    if (draggedItem) {
      e.preventDefault();
      const targetItem = e.target.closest(".bh-field-item");
      if (
        targetItem &&
        targetItem !== draggedItem &&
        targetItem.dataset.context === draggedItem.dataset.context
      ) {
        const rect = targetItem.getBoundingClientRect();
        const midY = rect.top + rect.height / 2;
        targetItem.classList.remove("bh-drag-over-top", "bh-drag-over-bottom");
        if (e.clientY < midY) {
          targetItem.classList.add("bh-drag-over-top");
        } else {
          targetItem.classList.add("bh-drag-over-bottom");
        }
      }
    }
  });

  document.addEventListener("drop", (e) => {
    if (draggedItem) {
      e.preventDefault();
      const targetItem = e.target.closest(".bh-field-item");
      if (
        targetItem &&
        targetItem !== draggedItem &&
        targetItem.dataset.context === draggedItem.dataset.context
      ) {
        const context = draggedItem.dataset.context;
        const oldIndex = parseInt(draggedItem.dataset.index);
        let newIndex = parseInt(targetItem.dataset.index);

        if (targetItem.classList.contains("bh-drag-over-bottom")) {
          newIndex++;
        }

        // Move item in array
        const item = currentSettings[context][oldIndex];
        currentSettings[context].splice(oldIndex, 1);

        if (oldIndex < newIndex) {
          newIndex--;
        }

        currentSettings[context].splice(newIndex, 0, item);

        if (context === "general") {
          renderFields("general", generalContainer);
        } else {
          renderFields(context, container);
        }
        updateState();
      }
    }
  });

  // Export
  const exportBtn = document.getElementById("bh-export-btn");
  if (exportBtn) {
    exportBtn.addEventListener("click", () => {
      const dataStr =
        "data:text/json;charset=utf-8," +
        encodeURIComponent(JSON.stringify(currentSettings, null, 2));
      const downloadAnchorNode = document.createElement("a");
      downloadAnchorNode.setAttribute("href", dataStr);
      downloadAnchorNode.setAttribute("download", "bh_theme_settings.json");
      document.body.appendChild(downloadAnchorNode);
      downloadAnchorNode.click();
      downloadAnchorNode.remove();
    });
  }

  // Copy Code
  const copyBtn = document.getElementById("bh-copy-code");
  if (copyBtn) {
    copyBtn.addEventListener("click", () => {
      const code = codeOutput.value;
      if (!code) {
        alert("No code to copy.");
        return;
      }

      codeOutput.select();
      document.execCommand("copy");

      const originalText = copyBtn.innerHTML;
      copyBtn.innerHTML =
        '<span class="dashicons dashicons-yes" style="margin-top: 3px;"></span> Copied!';
      copyBtn.classList.add("button-primary");

      setTimeout(() => {
        copyBtn.innerHTML = originalText;
        copyBtn.classList.remove("button-primary");
      }, 2000);
    });
  }

  // Initialize

  // Enforce General Settings (Logo & Favicon)
  if (!currentSettings["general"] || currentSettings["general"].length === 0) {
    currentSettings["general"] = [
      {
        name: "site_logo",
        label: "Site Logo",
        type: "image",
        value: "",
      },
      {
        name: "site_favicon",
        label: "Site Favicon",
        type: "image",
        value: "",
      },
    ];
  } else {
    // Ensure they exist even if data is present but partial
    const hasLogo = currentSettings["general"].some(
      (f) => f.name === "site_logo"
    );
    const hasFavicon = currentSettings["general"].some(
      (f) => f.name === "site_favicon"
    );

    if (!hasLogo) {
      currentSettings["general"].unshift({
        name: "site_logo",
        label: "Site Logo",
        type: "image",
        value: "",
      });
    }
    if (!hasFavicon) {
      currentSettings["general"].push({
        name: "site_favicon",
        label: "Site Favicon",
        type: "image",
        value: "",
      });
    }
  }

  // Move Import Form to Tools Tab
  const toolsTabContent = document.querySelector(
    "#tab-tools .bh-tool-section:last-child"
  );
  const importContainer = document.getElementById("bh-import-container");
  if (toolsTabContent && importContainer) {
    const importForm = importContainer.querySelector("form");
    if (importForm) {
      toolsTabContent.appendChild(importForm);
    }
  }

  renderFields("general", generalContainer);
  if (pageSelector.value) {
    renderFields(pageSelector.value, container);
  }
  settingsInput.value = JSON.stringify(currentSettings);
});
