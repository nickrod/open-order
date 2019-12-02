-- drop views

DROP VIEW IF EXISTS item_view;
DROP VIEW IF EXISTS gig_view;
DROP VIEW IF EXISTS service_view;
DROP VIEW IF EXISTS salesman_short_view;
DROP VIEW IF EXISTS salesman_view;
DROP VIEW IF EXISTS sales_item_view;
DROP VIEW IF EXISTS order_item_view;

-- drop tables

DROP TABLE IF EXISTS store_currency;

--

DROP TABLE IF EXISTS sales_order_sales_item;
DROP TABLE IF EXISTS store_sales_item;

--

DROP TABLE IF EXISTS user_account_store;

--

DROP TABLE IF EXISTS user_account_category;
DROP TABLE IF EXISTS sales_item_category;
DROP TABLE IF EXISTS sales_order_category;
DROP TABLE IF EXISTS store_category;
DROP TABLE IF EXISTS store_account_category;

--

DROP TABLE IF EXISTS user_account_location;

--

DROP TABLE IF EXISTS sales_item_favorite;
DROP TABLE IF EXISTS sales_order_favorite;

--

DROP TABLE IF EXISTS total;
DROP TABLE IF EXISTS sales_item_total;
DROP TABLE IF EXISTS sales_order_total;
DROP TABLE IF EXISTS store_total;
DROP TABLE IF EXISTS store_account_total;
DROP TABLE IF EXISTS check_in_total;
DROP TABLE IF EXISTS currency_total;
DROP TABLE IF EXISTS category_total;
DROP TABLE IF EXISTS location_total;
DROP TABLE IF EXISTS user_account_total;

--

DROP TABLE IF EXISTS sales_order;
DROP TABLE IF EXISTS store_account;
DROP TABLE IF EXISTS check_in;

--

DROP TABLE IF EXISTS currency_price;
DROP TABLE IF EXISTS currency;
DROP TABLE IF EXISTS sales_item;
DROP TABLE IF EXISTS store;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS city;
DROP TABLE IF EXISTS region;
DROP TABLE IF EXISTS catalog;

--

DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS user_account_active;
DROP TABLE IF EXISTS auth_token;
DROP TABLE IF EXISTS user_account;

-- create tables

CREATE TABLE admin (
  id SERIAL PRIMARY KEY,
  login_enabled BOOL NOT NULL DEFAULT TRUE,
  registration_enabled BOOL NOT NULL DEFAULT TRUE,
  max_accounts INT NOT NULL DEFAULT 10000
);

--

CREATE INDEX idx_admin_login_enabled ON admin(login_enabled);
CREATE INDEX idx_admin_registration_enabled ON admin(registration_enabled);

--

CREATE TABLE user_account (
  id SERIAL PRIMARY KEY,
  employee_id INT,
  email TEXT NOT NULL CHECK(TRIM(email) <> ''),
  name TEXT CHECK(TRIM(name) <> ''),
  username TEXT NOT NULL CHECK(TRIM(username) <> ''),
  phone TEXT NOT NULL CHECK(TRIM(phone) <> ''),
  password TEXT NOT NULL CHECK(TRIM(password) <> ''),
  admin BOOL NOT NULL DEFAULT FALSE,
  enabled BOOL NOT NULL DEFAULT TRUE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(employee_id),
  UNIQUE(email),
  UNIQUE(username),
  UNIQUE(phone)
);

--

CREATE INDEX idx_user_account_admin ON user_account(admin);
CREATE INDEX idx_user_account_enabled ON user_account(enabled);
CREATE INDEX idx_user_account_created_date ON user_account(created_date);
CREATE INDEX idx_user_account_updated_date ON user_account(updated_date);

--

CREATE TABLE user_account_active (
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(user_account_id)
);

--

CREATE INDEX idx_user_account_active_created_date ON user_account_active(created_date);

--

CREATE TABLE auth_token (
  id SERIAL PRIMARY KEY,
  token TEXT NOT NULL CHECK(TRIM(token) <> ''),
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  ip INET NOT NULL,
  enabled BOOL NOT NULL DEFAULT TRUE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_auth_token_user_account_id ON auth_token(user_account_id);
CREATE INDEX idx_auth_token_enabled ON auth_token(enabled);
CREATE INDEX idx_auth_token_created_date ON auth_token(created_date);

--

CREATE TABLE currency (
  id SERIAL PRIMARY KEY,
  code TEXT NOT NULL CHECK(TRIM(code) <> ''),
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  title_unit TEXT CHECK(TRIM(title_unit) <> ''),
  page_title TEXT CHECK(TRIM(page_title) <> ''),
  page_description TEXT CHECK(TRIM(page_description) <> ''),
  page_header TEXT CHECK(TRIM(page_header) <> ''),
  crypto BOOL NOT NULL DEFAULT FALSE,
  symbol TEXT NOT NULL CHECK(TRIM(symbol) <> ''),
  symbol_unit TEXT CHECK(TRIM(symbol_unit) <> ''),
  multiplier_unit INT,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(code),
  UNIQUE(title_url)
);

--

CREATE INDEX idx_currency_title ON currency(title);
CREATE INDEX idx_currency_title_unit ON currency(title_unit);
CREATE INDEX idx_currency_crypto ON currency(crypto);
CREATE INDEX idx_currency_created_date ON currency(created_date);
CREATE INDEX idx_currency_updated_date ON currency(updated_date);

--

CREATE TABLE currency_price (
  currency_id INT NOT NULL REFERENCES currency(id) ON DELETE CASCADE,
  price MONEY DEFAULT 0.00,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(currency_id)
);

--

CREATE INDEX idx_currency_price_price ON currency_price(price);
CREATE INDEX idx_currency_price_updated_date ON currency_price(updated_date);

--

CREATE TABLE category (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  page_title TEXT CHECK(TRIM(page_title) <> ''),
  page_description TEXT CHECK(TRIM(page_description) <> ''),
  page_header TEXT CHECK(TRIM(page_header) <> ''),
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(title),
  UNIQUE(title_url)
);

--

CREATE INDEX idx_category_featured ON category(featured);
CREATE INDEX idx_category_created_date ON category(created_date);
CREATE INDEX idx_category_updated_date ON category(updated_date);

--

CREATE TABLE sales_order (
  id SERIAL PRIMARY KEY,
  base_currency_id INT DEFAULT 1 REFERENCES currency(id) ON DELETE SET NULL,
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE SET NULL,
  store_id INT NOT NULL REFERENCES store(id) ON DELETE CASCADE,
  latitude DECIMAL(7,5),
  longitude DECIMAL(8,5),
  subtotal MONEY DEFAULT 0.00,
  total MONEY DEFAULT 0.00,
  enabled BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_sales_order_base_currency_id ON sales_order(base_currency_id);
CREATE INDEX idx_sales_order_user_account_id ON sales_order(user_account_id);
CREATE INDEX idx_sales_order_store_id ON sales_order(store_id);
CREATE INDEX idx_sales_order_latitude ON sales_order(latitude);
CREATE INDEX idx_sales_order_longitude ON sales_order(longitude);
CREATE INDEX idx_sales_order_subtotal ON sales_order(subtotal);
CREATE INDEX idx_sales_order_total ON sales_order(total);
CREATE INDEX idx_sales_order_enabled ON sales_order(enabled);
CREATE INDEX idx_sales_order_created_date ON sales_order(created_date);
CREATE INDEX idx_sales_order_updated_date ON sales_order(updated_date);

--

CREATE TABLE catalog (
  item_id INT NOT NULL,
  title TEXT,
  title_short TEXT,
  description TEXT,
  image_url TEXT,
  upc INT,
  retail_case_price MONEY,
  retail_unit_price MONEY,
  cost_case_price MONEY,
  cost_unit_price MONEY,
  pack_size TEXT,
  case_weight TEXT,
  case_volume TEXT,
  units INT,
  pallet_tie_height TEXT,
  category TEXT,
  unit_dimensions TEXT,
  case_dimensions TEXT,
  UNIQUE(upc),
  PRIMARY KEY(item_id)
);

--

CREATE TABLE region (
  geoname_id INT NOT NULL,
  title TEXT NOT NULL,
  code TEXT NOT NULL,
  UNIQUE(code),
  PRIMARY KEY(geoname_id)
);

--

CREATE TABLE city (
  geoname_id INT NOT NULL,
  title TEXT NOT NULL,
  title_region TEXT,
  title_combined TEXT,
  latitude DECIMAL(7,5),
  longitude DECIMAL(8,5),
  country_code CHAR(2),
  region_code TEXT,
  UNIQUE(title_combined),
  PRIMARY KEY(geoname_id)
);

--

CREATE TABLE location (
  id SERIAL PRIMARY KEY,
  latitude DECIMAL(7,5),
  longitude DECIMAL(8,5),
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_location_latitude ON location(latitude);
CREATE INDEX idx_location_longitude ON location(longitude);
CREATE INDEX idx_location_created_date ON location(created_date);

--

CREATE TABLE sales_item (
  id SERIAL PRIMARY KEY,
  item_id INT,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_short TEXT NOT NULL CHECK(TRIM(title_short) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  image TEXT CHECK(TRIM(image) <> ''),
  retail_case_price MONEY DEFAULT 0.00,
  retail_unit_price MONEY DEFAULT 0.00,
  cost_case_price MONEY DEFAULT 0.00,
  cost_unit_price MONEY DEFAULT 0.00,
  case_quantity INT NOT NULL DEFAULT 0,
  unit_quantity INT NOT NULL DEFAULT 0,
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(item_id)
);

--

CREATE INDEX idx_sales_item_title ON sales_item(title);
CREATE INDEX idx_sales_item_title_short ON sales_item(title_short);
CREATE INDEX idx_sales_item_retail_case_price ON sales_item(retail_case_price);
CREATE INDEX idx_sales_item_retail_unit_price ON sales_item(retail_unit_price);
CREATE INDEX idx_sales_item_cost_case_price ON sales_item(cost_case_price);
CREATE INDEX idx_sales_item_cost_unit_price ON sales_item(cost_unit_price);
CREATE INDEX idx_sales_item_case_quantity ON sales_item(case_quantity);
CREATE INDEX idx_sales_item_unit_quantity ON sales_item(unit_quantity);
CREATE INDEX idx_sales_item_featured ON sales_item(featured);
CREATE INDEX idx_sales_item_created_date ON sales_item(created_date);
CREATE INDEX idx_sales_item_updated_date ON sales_item(updated_date);

--

CREATE TABLE store_account (
  id SERIAL PRIMARY KEY,
  account_id INT,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(account_id)
);

--

CREATE INDEX idx_store_account_title ON store_account(title);
CREATE INDEX idx_store_account_featured ON store_account(featured);
CREATE INDEX idx_store_account_created_date ON store_account(created_date);
CREATE INDEX idx_store_account_updated_date ON store_account(updated_date);

--

CREATE TABLE check_in (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_check_in_title ON check_in(title);
CREATE INDEX idx_check_in_description ON check_in(description);
CREATE INDEX idx_check_in_user_account_id ON check_in(user_account_id);
CREATE INDEX idx_check_in_created_date ON check_in(created_date);
CREATE INDEX idx_check_in_updated_date ON check_in(updated_date);

--

CREATE TABLE store (
  id SERIAL PRIMARY KEY,
  store_id INT,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  latitude DECIMAL(7,5),
  longitude DECIMAL(8,5),
  featured BOOL NOT NULL DEFAULT FALSE,
  store_account_id INT NOT NULL REFERENCES store_account(id) ON DELETE CASCADE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(store_id)
);

--

CREATE INDEX idx_store_title ON store(title);
CREATE INDEX idx_store_latitude ON store(latitude);
CREATE INDEX idx_store_longitude ON store(longitude);
CREATE INDEX idx_store_featured ON store(featured);
CREATE INDEX idx_store_store_account_id ON store(store_account_id);
CREATE INDEX idx_store_created_date ON store(created_date);
CREATE INDEX idx_store_updated_date ON store(updated_date);

-- currency

CREATE TABLE store_currency (
  store_id INT NOT NULL REFERENCES store(id) ON DELETE CASCADE,
  currency_id INT NOT NULL REFERENCES currency(id) ON DELETE CASCADE,
  PRIMARY KEY(store_id, currency_id)
);

-- item

CREATE TABLE sales_order_sales_item (
  sales_order_id INT NOT NULL REFERENCES sales_order(id) ON DELETE CASCADE,
  sales_item_id INT NOT NULL REFERENCES sales_item(id) ON DELETE CASCADE,
  case_quantity INT NOT NULL DEFAULT 1,
  unit_quantity INT NOT NULL DEFAULT 0,
  case_price MONEY DEFAULT 0.00,
  unit_price MONEY DEFAULT 0.00,
  PRIMARY KEY(sales_order_id, sales_item_id)
);

--

CREATE INDEX idx_sales_order_sales_item_case_quantity ON sales_order_sales_item(case_quantity);
CREATE INDEX idx_sales_order_sales_item_unit_quantity ON sales_order_sales_item(unit_quantity);
CREATE INDEX idx_sales_order_sales_item_case_price ON sales_order_sales_item(case_price);
CREATE INDEX idx_sales_order_sales_item_unit_price ON sales_order_sales_item(unit_price);

--

CREATE TABLE store_sales_item (
  store_id INT NOT NULL REFERENCES store(id) ON DELETE CASCADE,
  sales_item_id INT NOT NULL REFERENCES sales_item(id) ON DELETE CASCADE,
  case_quantity INT NOT NULL DEFAULT 0,
  unit_quantity INT NOT NULL DEFAULT 0,
  case_price MONEY DEFAULT 0.00,
  unit_price MONEY DEFAULT 0.00,
  PRIMARY KEY(store_id, sales_item_id)
);

--

CREATE INDEX idx_store_sales_item_case_quantity ON store_sales_item(case_quantity);
CREATE INDEX idx_store_sales_item_unit_quantity ON store_sales_item(unit_quantity);
CREATE INDEX idx_store_sales_item_case_price ON store_sales_item(case_price);
CREATE INDEX idx_store_sales_item_unit_price ON store_sales_item(unit_price);

-- category

CREATE TABLE user_account_category (
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(user_account_id, category_id)
);

--

CREATE TABLE sales_item_category (
  sales_item_id INT NOT NULL REFERENCES sales_item(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(sales_item_id, category_id)
);

--

CREATE TABLE sales_order_category (
  sales_order_id INT NOT NULL REFERENCES sales_order(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(sales_order_id, category_id)
);

--

CREATE TABLE store_category (
  store_id INT NOT NULL REFERENCES store(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(store_id, category_id)
);

--

CREATE TABLE store_account_category (
  store_account_id INT NOT NULL REFERENCES store_account(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(store_account_id, category_id)
);

--

CREATE TABLE user_account_store (
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  store_id INT NOT NULL REFERENCES store(id) ON DELETE CASCADE,
  PRIMARY KEY(user_account_id, store_id)
);

-- location

CREATE TABLE user_account_location (
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  location_id INT NOT NULL REFERENCES location(id) ON DELETE CASCADE,
  PRIMARY KEY(user_account_id, location_id)
);

-- favorite

CREATE TABLE sales_item_favorite (
  sales_item_id INT NOT NULL REFERENCES sales_item(id) ON DELETE CASCADE,
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(sales_item_id, user_account_id)
);

--

CREATE TABLE sales_order_favorite (
  sales_order_id INT NOT NULL REFERENCES sales_order(id) ON DELETE CASCADE,
  user_account_id INT NOT NULL REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(sales_order_id, user_account_id)
);

-- total

CREATE TABLE total (
  id SERIAL PRIMARY KEY,
  total_accounts INT NOT NULL DEFAULT 0,
  total_accounts_active INT NOT NULL DEFAULT 0,
  total_currencies INT NOT NULL DEFAULT 0,
  total_categories INT NOT NULL DEFAULT 0,
  total_locations INT NOT NULL DEFAULT 0,
  total_sales_items INT NOT NULL DEFAULT 0,
  total_salesmans INT NOT NULL DEFAULT 0
);

--

CREATE TABLE salesman_total (
  salesman_id INT NOT NULL REFERENCES salesman(id) ON DELETE CASCADE,
  total_favorites INT NOT NULL DEFAULT 0,
  PRIMARY KEY(salesman_id)
);

--

CREATE INDEX idx_salesman_total_total_favorites ON salesman_total(total_favorites);

--

CREATE TABLE item_total (
  item_id INT NOT NULL REFERENCES item(id) ON DELETE CASCADE,
  total_favorites INT NOT NULL DEFAULT 0,
  PRIMARY KEY(item_id)
);

--

CREATE INDEX idx_item_total_total_favorites ON item_total(total_favorites);

--

CREATE TABLE gig_total (
  gig_id INT NOT NULL REFERENCES gig(id) ON DELETE CASCADE,
  total_favorites INT NOT NULL DEFAULT 0,
  PRIMARY KEY(gig_id)
);

--

CREATE INDEX idx_gig_total_total_favorites ON gig_total(total_favorites);

--

CREATE TABLE service_total (
  service_id INT NOT NULL REFERENCES service(id) ON DELETE CASCADE,
  total_favorites INT NOT NULL DEFAULT 0,
  PRIMARY KEY(service_id)
);

--

CREATE INDEX idx_service_total_total_favorites ON service_total(total_favorites);

--

CREATE TABLE currency_total (
  currency_id INT NOT NULL REFERENCES currency(id) ON DELETE CASCADE,
  total_salesmans INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(currency_id)
);

--

CREATE INDEX idx_currency_total_total_salesmans ON currency_total(total_salesmans);
CREATE INDEX idx_currency_total_total_gigs ON currency_total(total_gigs);
CREATE INDEX idx_currency_total_total_services ON currency_total(total_services);

--

CREATE TABLE category_total (
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  total_items INT NOT NULL DEFAULT 0,
  total_salesmans INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(category_id)
);

--

CREATE INDEX idx_category_total_total_items ON category_total(total_items);
CREATE INDEX idx_category_total_total_salesmans ON category_total(total_salesmans);
CREATE INDEX idx_category_total_total_gigs ON category_total(total_gigs);
CREATE INDEX idx_category_total_total_services ON category_total(total_services);

--

CREATE TABLE location_total (
  location_id INT NOT NULL REFERENCES location(id) ON DELETE CASCADE,
  total_salesmans INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(location_id)
);

--

CREATE INDEX idx_location_total_total_salesmans ON location_total(total_salesmans);
CREATE INDEX idx_location_total_total_gigs ON location_total(total_gigs);
CREATE INDEX idx_location_total_total_services ON location_total(total_services);

--

CREATE TABLE account_total (
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  total_item_favorites INT NOT NULL DEFAULT 0,
  total_salesman_favorites INT NOT NULL DEFAULT 0,
  total_gig_favorites INT NOT NULL DEFAULT 0,
  total_service_favorites INT NOT NULL DEFAULT 0,
  total_items INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(account_id)
);

--

CREATE INDEX idx_account_total_total_item_favorites ON account_total(total_item_favorites);
CREATE INDEX idx_account_total_total_salesman_favorites ON account_total(total_salesman_favorites);
CREATE INDEX idx_account_total_total_gig_favorites ON account_total(total_gig_favorites);
CREATE INDEX idx_account_total_total_service_favorites ON account_total(total_service_favorites);
CREATE INDEX idx_account_total_total_items ON account_total(total_items);
CREATE INDEX idx_account_total_total_gigs ON account_total(total_gigs);
CREATE INDEX idx_account_total_total_services ON account_total(total_services);

-- create views

CREATE VIEW item_view
AS
SELECT account.id AS item_view_id, username, chat_online
FROM account
INNER JOIN account_active ON account.id = account_active.account_id;

--

CREATE VIEW salesman_view
AS
SELECT *
FROM salesman
INNER JOIN item_view ON salesman.account_id = item_view.item_view_id;

--

CREATE VIEW salesman_short_view
AS
SELECT salesman.id AS salesman_short_view_id, salesman.title AS salesman_title, salesman.title_url AS salesman_url, image_thumb, username, chat_online
FROM salesman
INNER JOIN item_view ON salesman.account_id = item_view.item_view_id;

--

CREATE VIEW item_view
AS
SELECT *
FROM item
INNER JOIN salesman_short_view ON item.salesman_id = salesman_short_view.salesman_short_view_id;

--

CREATE VIEW gig_view
AS
SELECT *
FROM gig
INNER JOIN salesman_short_view ON gig.salesman_id = salesman_short_view.salesman_short_view_id;

--

CREATE VIEW service_view
AS
SELECT *
FROM service
INNER JOIN salesman_short_view ON service.salesman_id = salesman_short_view.salesman_short_view_id;
