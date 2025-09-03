# Magento 2 Modules

Magento 2 modules for learning, experimenting, and quickly implementing common features.

---

## 🚀 Overview

This repository provides a set of standalone modules, each focusing on a specific concept or feature in Magento 2. The goal is to make learning Magento 2 development easier by offering ready-to-use code samples that demonstrate best practices in a clean and minimal way. Clone it, try out the modules, and see how Magento 2 works under the hood.

---

## 🧩 Key Features

- **Modular Structure:**  
  Each folder is a separate, fully functional Magento 2 module. Pick only the samples you need—no bloated codebase or tangled dependencies!

- **Comprehensive Coverage:**  
  The modules cover a wide range of core Magento 2 topics, including:
  - **Backend Development:**  
    Custom models, resources, and collections for efficient database interactions.
  - **Frontend Development:**  
    Adding new pages, custom templates, and managing layouts.
  - **API Development:**  
    Building custom REST APIs and exposing Magento data.
  - **CLI Commands:**  
    Creating bespoke command-line tools for Magento administration.
  - **Cron Jobs:**  
    Automating scheduled tasks within Magento.
  - **Plugins & Observers:**  
    Extending core functionality the Magento way—without core hacks.

- **Hands-On Learning:**  
  Each module is designed to be minimal, clear, and focused—perfect for use alongside tutorials, or as boilerplate for your own projects.

---
## 📦 Modules List

Below is a table listing all modules included in this repository, along with a brief description of each.
| Module       | Description                                                              |
|------------------|--------------------------------------------------------------------------|
| [SMG_Minimal](https://github.com/supravatm/magento2-basic-modules/tree/master/01.%20Minimal)      | Minimal example module demonstrating the basic structure of a Magento 2 module. |
| [SMG_WebFlow](https://github.com/supravatm/magento2-basic-modules/tree/master/02.%20WebFlow)      | Demonstrates frontend page creation, routing, and layout XML usage. |
| [SMG_RestApiTest](https://github.com/supravatm/magento2-basic-modules/tree/master/03.%20RestApiFlow)  | Provides a custom REST API endpoint and demonstrates API registration. |
| [SMG_CustomCache](https://github.com/supravatm/magento2-basic-modules/tree/master/04.%20CustomCache)  | Shows how to implement custom cache types and caching strategies. |
| [SMG_CustomCron](https://github.com/supravatm/magento2-basic-modules/tree/master/06.%20CustomCron)  | Demonstrates creation and scheduling of custom cron jobs in Magento 2. |
| [SMG_CustomAddProductAttribute](https://github.com/supravatm/magento2-basic-modules/tree/master/07.%20CustomAddProductAttribute)  | Teaches adding new product attributes programmatically during module setup. |
| [SMG_OrderExtensionAttribute](https://github.com/supravatm/magento2-basic-modules/tree/master/08.%20OrderExtensionAttribute)  | Demonstrates how to add extension attributes to order entities. |
| [SMG_CustomCustomerAttribute](https://github.com/supravatm/magento2-basic-modules/tree/master/09.%20CustomCustomerAttribute)  | Shows how to add custom attributes to customer entities. |
| [SMG_CustomShippingCarrier](https://github.com/supravatm/magento2-basic-modules/tree/master/11.%20CustomShippingCarrier)  | Demonstrates creation of a custom shipping carrier for checkout. |
| [SMG_DeliveryCarrier](https://github.com/supravatm/magento2-basic-modules/tree/master/11.%20DeliveryCarrier) | Sample module for implementing delivery carrier functionality. |
| [SMG_CustomPaymentOffline](https://github.com/supravatm/magento2-basic-modules/tree/master/12.%20CustomPaymentOffline)  | Shows how to add a custom offline payment method. |
| [SMG_AddCheckoutStep](https://github.com/supravatm/magento2-basic-modules/tree/master/13.%20AddCheckoutStep)  | Teaches how to add a custom step to the checkout process. |
| [SMG_AddCheckoutAddressField](https://github.com/supravatm/magento2-basic-modules/tree/master/14.%20AddCheckoutAddressField)  | Demonstrates adding custom address fields in checkout. |
| [SMG_CartItemRenderer](https://github.com/supravatm/magento2-basic-modules/tree/master/15.%20CartItemRenderer)  | Shows how to customize cart item rendering in the frontend. |
| [SMG_CheckoutDeliveryDate](https://github.com/supravatm/magento2-basic-modules/tree/master/16.%20CheckoutDeliveryDate)  | Adds a delivery date field to the checkout and saves it with the order. |
| [SMG_CheckoutValidateBeforePlaceOrder](https://github.com/supravatm/magento2-basic-modules/tree/master/17.%20CheckoutValidateBeforePlaceOrder)  | Demonstrates validation logic before order placement in checkout. |
| [SMG_ControllerResponseTypes](https://github.com/supravatm/magento2-basic-modules/tree/master/18.%20ControllerResponseTypes)  | Shows different controller response types (JSON, redirect, etc.). |
| [SMG_CoreExtended ](https://github.com/supravatm/magento2-basic-modules/tree/master/19.%20CoreExtended) | Demonstrates extending core Magento functionality via preferences or plugins. |
| [SMG_CustomCommand](https://github.com/supravatm/magento2-basic-modules/tree/master/20.%20CustomCommand)  | Shows how to create custom CLI commands for bin/magento. |
| [SMG_CustomerTelephoneValidate](https://github.com/supravatm/magento2-basic-modules/tree/master/21.%20CustomerTelephoneValidate)  | Adds custom validation for customer telephone fields. |
| [SMG_CustomFee](https://github.com/supravatm/magento2-basic-modules/tree/master/22.%20CustomFee)  | Demonstrates adding a custom fee to the quote and order totals. |
| [SMG_CustomFieldToQuoteItem](https://github.com/supravatm/magento2-basic-modules/tree/master/23.%20CustomFieldToQuoteItem)  | Shows how to add a custom field to quote items. |
| [SMG_CustomProductAttribute](https://github.com/supravatm/magento2-basic-modules/tree/master/24.%20CustomProductAttribute)  | Teaches adding custom product attributes and their management. |
| [SMG_CustomRoute](https://github.com/supravatm/magento2-basic-modules/tree/master/25.%20CustomRoute)  | Demonstrates defining custom frontend or admin routes. |
| [SMG_EmailChecker](https://github.com/supravatm/magento2-basic-modules/tree/master/26.%20EmailChecker)  | Shows email validation or checking logic during customer registration. |
| [SMG_ExemptProductType](https://github.com/supravatm/magento2-basic-modules/tree/master/27.%20ExemptProductType)  | Demonstrates how to exempt specific product types from validation or logic. |
| [SMG_News](https://github.com/supravatm/magento2-basic-modules/tree/master/28.%20News)  | Sample module for creating a simple news entity and frontend display. |
| [SMG_PluginExample](https://github.com/supravatm/magento2-basic-modules/tree/master/29.%20PluginExample)  | Demonstrates usage of plugins (interceptors) for method modification. |
| [SMG_RestApiProductComment](https://github.com/supravatm/magento2-basic-modules/tree/master/30.%20RestApiProductComment)  | Adds a REST API for product comments or reviews. |
| [SMG_SendOrder](https://github.com/supravatm/magento2-basic-modules/tree/master/31.%20SendOrder)  | Shows how to send order data to external systems or via custom logic. |
| [SMG_RabbitMQExample](https://github.com/supravatm/magento2-basic-modules/tree/master/32.%20RabbitMQExample)  | Demonstrates message queue usage with RabbitMQ integration. |

---

## 📚 Getting Started

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/supravatm/magento2-basic-modules.git
   ```

2. **Install Modules:**
   - Copy the desired module folder(s) into your Magento 2 installation's `app/code` directory.
   - Enable the module(s) using Magento CLI:
     ```bash
     php bin/magento setup:upgrade
     ```

3. **Explore & Experiment:**
   - Check each module’s README (if available) for details.
   - Use the code for learning, reference, or as a starting point for your own projects.

---

## 💡 Who Is This For?

- **Magento 2 Beginners:**  
  Learn how the framework works by seeing real, working code samples.
- **Experienced Developers:**  
  Grab quick references and boilerplate implementations for common tasks.
- **Tutorial Writers & Trainers:**  
  Use the modules as teaching aids or demo resources.

---

## 📝 License

This repository is licensed under the [MIT License](https://opensource.org/licenses/MIT).  
Feel free to use, adapt, and share!

---

&copy; 2018 Supravat M