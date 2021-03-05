-- drop tables

DROP TABLE IF EXISTS sales_order_sales_item;

--

DROP TABLE IF EXISTS user_account_store;

--

DROP TABLE IF EXISTS sales_item_category;
DROP TABLE IF EXISTS sales_order_category;
DROP TABLE IF EXISTS store_category;
DROP TABLE IF EXISTS store_account_category;
DROP TABLE IF EXISTS user_account_category;

--

DROP TABLE IF EXISTS sales_item_favorite;
DROP TABLE IF EXISTS sales_order_favorite;
DROP TABLE IF EXISTS store_favorite;
DROP TABLE IF EXISTS store_account_favorite;
DROP TABLE IF EXISTS user_account_favorite;

--

DROP TABLE IF EXISTS total;

--

DROP TABLE IF EXISTS sales_order;
DROP TABLE IF EXISTS sales_item;
DROP TABLE IF EXISTS store;
DROP TABLE IF EXISTS store_account;

--

DROP TABLE IF EXISTS currency;
DROP TABLE IF EXISTS category;

--

DROP TABLE IF EXISTS user_account_auth;
DROP TABLE IF EXISTS user_account;

-- create tables

CREATE TABLE user_account (
  id SERIAL PRIMARY KEY,
  email TEXT NOT NULL CHECK(TRIM(email) <> ''),
  name TEXT NOT NULL CHECK(TRIM(name) <> ''),
  name_url TEXT NOT NULL CHECK(TRIM(name_url) <> ''),
  phone TEXT CHECK(TRIM(phone) <> ''),
  password TEXT CHECK(TRIM(password) <> ''),
  pubkey TEXT CHECK(TRIM(pubkey) <> ''),
  account_id INT CHECK(account_id > 0),
  min_order_price INT CHECK(min_order_price > 0),
  max_order_price INT CHECK(max_order_price > 0),
  admin BOOL NOT NULL DEFAULT FALSE,
  registered BOOL NOT NULL DEFAULT FALSE,
  enabled BOOL NOT NULL DEFAULT TRUE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(email),
  UNIQUE(name),
  UNIQUE(name_url),
  UNIQUE(phone),
  UNIQUE(account_id)
);

--

CREATE INDEX idx_user_account_email_enabled_registered ON user_account(email, enabled, registered);
CREATE INDEX idx_user_account_updated_date ON user_account(updated_date);

--

CREATE TABLE user_account_auth (
  id SERIAL PRIMARY KEY,
  selector TEXT CHECK(TRIM(selector) <> ''),
  validator TEXT CHECK(TRIM(validator) <> ''),
  ip INET,
  user_account_id INT NOT NULL CHECK(user_account_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  enabled BOOL NOT NULL DEFAULT TRUE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(selector)
);

--

CREATE INDEX idx_user_account_auth_selector_enabled ON user_account_auth(selector, enabled);
CREATE INDEX idx_user_account_auth_user_account_id ON user_account_auth(user_account_id);
CREATE INDEX idx_user_account_auth_updated_date ON user_account_auth(updated_date);

--

CREATE TABLE currency (
  id SERIAL PRIMARY KEY,
  code TEXT NOT NULL CHECK(TRIM(code) <> ''),
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  title_unit TEXT CHECK(TRIM(title_unit) <> ''),
  symbol TEXT CHECK(TRIM(symbol) <> ''),
  symbol_unit TEXT CHECK(TRIM(symbol_unit) <> ''),
  multiplier_unit INT CHECK(multiplier_unit > 0),
  price FLOAT CHECK(price > 0),
  featured BOOL NOT NULL DEFAULT FALSE,
  crypto BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(code),
  UNIQUE(title),
  UNIQUE(title_url)
);

--

CREATE INDEX idx_currency_featured ON currency(featured);
CREATE INDEX idx_currency_updated_date ON currency(updated_date);

--

CREATE TABLE category (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(title),
  UNIQUE(title_url)
);

--

CREATE INDEX idx_category_featured ON category(featured);
CREATE INDEX idx_category_updated_date ON category(updated_date);

--

CREATE TABLE store_account (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  account_id INT CHECK(account_id > 0),
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(title),
  UNIQUE(title_url),
  UNIQUE(account_id)
);

--

CREATE INDEX idx_store_account_featured ON store_account(featured);
CREATE INDEX idx_store_account_updated_date ON store_account(updated_date);

--

CREATE TABLE store (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  store_account_title_url TEXT NOT NULL CHECK(TRIM(store_account_title_url) <> '') REFERENCES store_account(title_url) ON DELETE CASCADE,
  store_id INT CHECK(store_id > 0),
  store_number INT CHECK(store_number > 0),
  latitude FLOAT CHECK(latitude > 0),
  longitude FLOAT CHECK(longitude > 0),
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(title),
  UNIQUE(title_url),
  UNIQUE(store_id),
  UNIQUE(latitude, longitude)
);

--

CREATE INDEX idx_store_store_account_title_url ON store(store_account_title_url);
CREATE INDEX idx_store_featured ON store(featured);
CREATE INDEX idx_store_updated_date ON store(updated_date);

--

CREATE TABLE sales_order (
  id SERIAL PRIMARY KEY,
  notes TEXT CHECK(TRIM(notes) <> ''),
  currency_code TEXT NOT NULL CHECK(TRIM(currency_code) <> '') REFERENCES currency(code) ON DELETE CASCADE,
  base_currency_code TEXT NOT NULL CHECK(TRIM(base_currency_code) <> '') REFERENCES currency(code) ON DELETE CASCADE,
  user_account_name_url TEXT CHECK(TRIM(user_account_name_url) <> '') REFERENCES user_account(name_url) ON DELETE SET NULL,
  store_title_url TEXT NOT NULL CHECK(TRIM(store_title_url) <> '') REFERENCES store(title_url) ON DELETE CASCADE,
  base_store_title_url TEXT NOT NULL CHECK(TRIM(base_store_title_url) <> '') REFERENCES store(title_url) ON DELETE CASCADE,
  order_id INT CHECK(order_id > 0),
  total_weight INT CHECK(total_weight > 0),
  total_volume INT CHECK(total_volume > 0),
  currency_price FLOAT CHECK(currency_price > 0),
  shipping_price INT CHECK(shipping_price > 0),
  tax_price INT CHECK(tax_price > 0),
  subtotal_price INT CHECK(subtotal_price > 0),
  discount_price INT CHECK(discount_price > 0),
  total_price INT CHECK(total_price > 0),
  case_quantity INT CHECK(case_quantity > 0),
  unit_quantity INT CHECK(unit_quantity > 0),
  latitude FLOAT CHECK(latitude > 0),
  longitude FLOAT CHECK(longitude > 0),
  distance FLOAT CHECK(distance > 0),
  pickup BOOL NOT NULL DEFAULT FALSE,
  paid BOOL NOT NULL DEFAULT FALSE,
  enabled BOOL NOT NULL DEFAULT FALSE,
  deliver_date TIMESTAMPTZ,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(order_id),
  UNIQUE(latitude, longitude)
);

--

CREATE INDEX idx_sales_order_currency_code ON sales_order(currency_code);
CREATE INDEX idx_sales_order_base_currency_code ON sales_order(base_currency_code);
CREATE INDEX idx_sales_order_user_account_name_url ON sales_order(user_account_name_url);
CREATE INDEX idx_sales_order_store_title_url ON sales_order(store_title_url);
CREATE INDEX idx_sales_order_base_store_title_url ON sales_order(base_store_title_url);
CREATE INDEX idx_sales_order_total_weight ON sales_order(total_weight);
CREATE INDEX idx_sales_order_total_volume ON sales_order(total_volume);
CREATE INDEX idx_sales_order_total_price ON sales_order(total_price);
CREATE INDEX idx_sales_order_distance ON sales_order(distance);
CREATE INDEX idx_sales_order_enabled ON sales_order(enabled);
CREATE INDEX idx_sales_order_updated_date ON sales_order(updated_date);

--

CREATE TABLE sales_item (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  image_url TEXT CHECK(TRIM(image_url) <> ''),
  upc TEXT CHECK(TRIM(upc) <> ''),
  case_dimension TEXT CHECK(TRIM(case_dimension) <> ''),
  unit_dimension TEXT CHECK(TRIM(unit_dimension) <> ''),
  item_id INT CHECK(item_id > 0),
  unit_case INT CHECK(unit_case > 0),
  case_weight INT CHECK(case_weight > 0),
  unit_weight INT CHECK(unit_weight > 0),
  case_volume INT CHECK(case_volume > 0),
  unit_volume INT CHECK(unit_volume > 0),
  case_price INT CHECK(case_price > 0),
  unit_price INT CHECK(unit_price > 0),
  case_cost_price INT CHECK(case_cost_price > 0),
  unit_cost_price INT CHECK(unit_cost_price > 0),
  case_discount_percent INT CHECK(case_discount_percent > 0),
  unit_discount_percent INT CHECK(unit_discount_percent > 0),
  case_discount_quantity INT CHECK(case_discount_quantity > 0),
  unit_discount_quantity INT CHECK(unit_discount_quantity > 0),
  featured BOOL NOT NULL DEFAULT FALSE,
  instock BOOL NOT NULL DEFAULT TRUE,
  instock_date TIMESTAMPTZ,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(title),
  UNIQUE(title_url),
  UNIQUE(upc),
  UNIQUE(item_id)
);

--

CREATE INDEX idx_sales_item_featured ON sales_item(featured);
CREATE INDEX idx_sales_item_updated_date ON sales_item(updated_date);

-- sales item

CREATE TABLE sales_order_sales_item (
  sales_order_id INT NOT NULL CHECK(sales_order_id > 0) REFERENCES sales_order(id) ON DELETE CASCADE,
  sales_item_id INT NOT NULL CHECK(sales_item_id > 0) REFERENCES sales_item(id) ON DELETE CASCADE,
  case_volume INT CHECK(case_volume > 0),
  unit_volume INT CHECK(unit_volume > 0),
  case_weight INT CHECK(case_weight > 0),
  unit_weight INT CHECK(unit_weight > 0),
  case_price INT CHECK(case_price > 0),
  unit_price INT CHECK(unit_price > 0),
  case_cost_price INT CHECK(case_cost_price > 0),
  unit_cost_price INT CHECK(unit_cost_price > 0),
  case_quantity INT CHECK(case_quantity > 0),
  unit_quantity INT CHECK(unit_quantity > 0),
  case_discount_price INT CHECK(case_discount_price > 0),
  unit_discount_price INT CHECK(unit_discount_price > 0),
  case_discount_percent INT CHECK(case_discount_percent > 0),
  unit_discount_percent INT CHECK(unit_discount_percent > 0),
  case_discount_quantity INT CHECK(case_discount_quantity > 0),
  unit_discount_quantity INT CHECK(unit_discount_quantity > 0),
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(sales_item_id, sales_order_id)
);

-- store

CREATE TABLE user_account_store (
  user_account_id INT NOT NULL CHECK(user_account_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  store_id INT NOT NULL CHECK(store_id > 0) REFERENCES store(id) ON DELETE CASCADE,
  PRIMARY KEY(store_id, user_account_id)
);

-- category

CREATE TABLE sales_item_category (
  sales_item_id INT NOT NULL CHECK(sales_item_id > 0) REFERENCES sales_item(id) ON DELETE CASCADE,
  category_id INT NOT NULL CHECK(category_id > 0) REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(category_id, sales_item_id)
);

--

CREATE TABLE sales_order_category (
  sales_order_id INT NOT NULL CHECK(sales_order_id > 0) REFERENCES sales_order(id) ON DELETE CASCADE,
  category_id INT NOT NULL CHECK(category_id > 0) REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(category_id, sales_order_id)
);

--

CREATE TABLE store_category (
  store_id INT NOT NULL CHECK(store_id > 0) REFERENCES store(id) ON DELETE CASCADE,
  category_id INT NOT NULL CHECK(category_id > 0) REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(category_id, store_id)
);

--

CREATE TABLE store_account_category (
  store_account_id INT NOT NULL CHECK(store_account_id > 0) REFERENCES store_account(id) ON DELETE CASCADE,
  category_id INT NOT NULL CHECK(category_id > 0) REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(category_id, store_account_id)
);

--

CREATE TABLE user_account_category (
  user_account_id INT NOT NULL CHECK(user_account_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  category_id INT NOT NULL CHECK(category_id > 0) REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(category_id, user_account_id)
);

-- favorite

CREATE TABLE sales_item_favorite (
  sales_item_id INT NOT NULL CHECK(sales_item_id > 0) REFERENCES sales_item(id) ON DELETE CASCADE,
  favorite_id INT NOT NULL CHECK(favorite_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(favorite_id, sales_item_id)
);

--

CREATE TABLE sales_order_favorite (
  sales_order_id INT NOT NULL CHECK(sales_order_id > 0) REFERENCES sales_order(id) ON DELETE CASCADE,
  favorite_id INT NOT NULL CHECK(favorite_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(favorite_id, sales_order_id)
);

--

CREATE TABLE store_favorite (
  store_id INT NOT NULL CHECK(store_id > 0) REFERENCES store(id) ON DELETE CASCADE,
  favorite_id INT NOT NULL CHECK(favorite_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(favorite_id, store_id)
);

--

CREATE TABLE store_account_favorite (
  store_account_id INT NOT NULL CHECK(store_account_id > 0) REFERENCES store_account(id) ON DELETE CASCADE,
  favorite_id INT NOT NULL CHECK(favorite_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(favorite_id, store_account_id)
);

--

CREATE TABLE user_account_favorite (
  user_account_id INT NOT NULL CHECK(user_account_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  favorite_id INT NOT NULL CHECK(favorite_id > 0) REFERENCES user_account(id) ON DELETE CASCADE,
  PRIMARY KEY(favorite_id, user_account_id)
);

-- total

CREATE TABLE total (
  id SERIAL PRIMARY KEY,
  total_user_account INT NOT NULL DEFAULT 0,
  total_currency INT NOT NULL DEFAULT 0,
  total_category INT NOT NULL DEFAULT 0,
  total_sales_item INT NOT NULL DEFAULT 0,
  total_sales_order INT NOT NULL DEFAULT 0,
  total_store_account INT NOT NULL DEFAULT 0,
  total_store INT NOT NULL DEFAULT 0
);
