-- drop views

DROP VIEW IF EXISTS blog_view;
DROP VIEW IF EXISTS gig_view;
DROP VIEW IF EXISTS service_view;
DROP VIEW IF EXISTS consultant_short_view;
DROP VIEW IF EXISTS consultant_view;
DROP VIEW IF EXISTS item_view;

-- drop tables

DROP TABLE IF EXISTS consultant_currency;
DROP TABLE IF EXISTS gig_currency;
DROP TABLE IF EXISTS service_currency;

--

DROP TABLE IF EXISTS consultant_category;
DROP TABLE IF EXISTS blog_category;
DROP TABLE IF EXISTS gig_category;
DROP TABLE IF EXISTS service_category;

--

DROP TABLE IF EXISTS consultant_location;
DROP TABLE IF EXISTS gig_location;
DROP TABLE IF EXISTS service_location;

--

DROP TABLE IF EXISTS consultant_favorite;
DROP TABLE IF EXISTS blog_favorite;
DROP TABLE IF EXISTS gig_favorite;
DROP TABLE IF EXISTS service_favorite;

--

DROP TABLE IF EXISTS total;
DROP TABLE IF EXISTS consultant_total;
DROP TABLE IF EXISTS blog_total;
DROP TABLE IF EXISTS gig_total;
DROP TABLE IF EXISTS service_total;
DROP TABLE IF EXISTS currency_total;
DROP TABLE IF EXISTS category_total;
DROP TABLE IF EXISTS location_total;
DROP TABLE IF EXISTS account_total;

--

DROP TABLE IF EXISTS blog;
DROP TABLE IF EXISTS gig;
DROP TABLE IF EXISTS service;
DROP TABLE IF EXISTS consultant;

--

DROP TABLE IF EXISTS currency_price;
DROP TABLE IF EXISTS currency;
DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS city;
DROP TABLE IF EXISTS region;

--

DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS account_active;
DROP TABLE IF EXISTS auth_token;
DROP TABLE IF EXISTS account;

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

CREATE TABLE account (
  id SERIAL PRIMARY KEY,
  email TEXT NOT NULL CHECK(TRIM(email) <> ''),
  nickname TEXT CHECK(TRIM(nickname) <> ''),
  username TEXT NOT NULL CHECK(TRIM(username) <> ''),
  password TEXT NOT NULL CHECK(TRIM(password) <> ''),
  admin BOOL NOT NULL DEFAULT FALSE,
  enabled BOOL NOT NULL DEFAULT TRUE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(email),
  UNIQUE(username)
);

--

CREATE INDEX idx_account_admin ON account(admin);
CREATE INDEX idx_account_enabled ON account(enabled);
CREATE INDEX idx_account_created_date ON account(created_date);
CREATE INDEX idx_account_updated_date ON account(updated_date);

--

CREATE TABLE account_active (
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  chat_online BOOL NOT NULL DEFAULT FALSE,
  site_online BOOL NOT NULL DEFAULT FALSE,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY(account_id)
);

--

CREATE INDEX idx_account_active_chat_online ON account_active(chat_online);
CREATE INDEX idx_account_active_site_online ON account_active(site_online);
CREATE INDEX idx_account_active_updated_date ON account_active(updated_date);

--

CREATE TABLE auth_token (
  id SERIAL PRIMARY KEY,
  token TEXT NOT NULL CHECK(TRIM(token) <> ''),
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  ip INET NOT NULL,
  enabled BOOL NOT NULL DEFAULT TRUE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

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
  featured BOOL NOT NULL DEFAULT FALSE,
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
CREATE INDEX idx_currency_featured ON currency(featured);
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
  geoname_id INT NOT NULL REFERENCES city(geoname_id) ON DELETE CASCADE DEFERRABLE,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  page_title TEXT CHECK(TRIM(page_title) <> ''),
  page_description TEXT CHECK(TRIM(page_description) <> ''),
  page_header TEXT CHECK(TRIM(page_header) <> ''),
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(geoname_id),
  UNIQUE(title_url)
);

--

CREATE INDEX idx_location_title ON location(title);
CREATE INDEX idx_location_featured ON location(featured);
CREATE INDEX idx_location_created_date ON location(created_date);
CREATE INDEX idx_location_updated_date ON location(updated_date);

-- item

CREATE TABLE consultant (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_short TEXT CHECK(TRIM(title_short) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  description_short TEXT CHECK(TRIM(description_short) <> ''),
  website_url TEXT CHECK(TRIM(website_url) <> ''),
  calendar_url TEXT CHECK(TRIM(calendar_url) <> ''),
  image TEXT CHECK(TRIM(image) <> ''),
  image_thumb TEXT CHECK(TRIM(image_thumb) <> ''),
  rate MONEY DEFAULT 0.00,
  base_currency_id INT DEFAULT 1 REFERENCES currency(id) ON DELETE SET NULL,
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_consultant_title ON consultant(title);
CREATE INDEX idx_consultant_rate ON consultant(rate);
CREATE INDEX idx_consultant_base_currency_id ON consultant(base_currency_id);
CREATE INDEX idx_consultant_account_id ON consultant(account_id);
CREATE INDEX idx_consultant_featured ON consultant(featured);
CREATE INDEX idx_consultant_created_date ON consultant(created_date);
CREATE INDEX idx_consultant_updated_date ON consultant(updated_date);

--

CREATE TABLE blog (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_short TEXT CHECK(TRIM(title_short) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  description_short TEXT CHECK(TRIM(description_short) <> ''),
  canonical_url TEXT NOT NULL CHECK(TRIM(canonical_url) <> ''),
  image TEXT CHECK(TRIM(image) <> ''),
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_blog_title ON blog(title);
CREATE INDEX idx_blog_consultant_id ON blog(consultant_id);
CREATE INDEX idx_blog_featured ON blog(featured);
CREATE INDEX idx_blog_created_date ON blog(created_date);
CREATE INDEX idx_blog_updated_date ON blog(updated_date);

--

CREATE TABLE gig (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_short TEXT CHECK(TRIM(title_short) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  description_short TEXT CHECK(TRIM(description_short) <> ''),
  canonical_url TEXT NOT NULL CHECK(TRIM(canonical_url) <> ''),
  salary MONEY DEFAULT 0.00,
  base_currency_id INT DEFAULT 1 REFERENCES currency(id) ON DELETE SET NULL,
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_gig_title ON gig(title);
CREATE INDEX idx_gig_salary ON gig(salary);
CREATE INDEX idx_gig_base_currency_id ON gig(base_currency_id);
CREATE INDEX idx_gig_consultant_id ON gig(consultant_id);
CREATE INDEX idx_gig_featured ON gig(featured);
CREATE INDEX idx_gig_created_date ON gig(created_date);
CREATE INDEX idx_gig_updated_date ON gig(updated_date);

--

CREATE TABLE service (
  id SERIAL PRIMARY KEY,
  title TEXT NOT NULL CHECK(TRIM(title) <> ''),
  title_short TEXT CHECK(TRIM(title_short) <> ''),
  title_url TEXT NOT NULL CHECK(TRIM(title_url) <> ''),
  description TEXT NOT NULL CHECK(TRIM(description) <> ''),
  description_short TEXT CHECK(TRIM(description_short) <> ''),
  canonical_url TEXT NOT NULL CHECK(TRIM(canonical_url) <> ''),
  price MONEY DEFAULT 0.00,
  base_currency_id INT DEFAULT 1 REFERENCES currency(id) ON DELETE SET NULL,
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  featured BOOL NOT NULL DEFAULT FALSE,
  created_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_date TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--

CREATE INDEX idx_service_title ON service(title);
CREATE INDEX idx_service_price ON service(price);
CREATE INDEX idx_service_base_currency_id ON service(base_currency_id);
CREATE INDEX idx_service_consultant_id ON service(consultant_id);
CREATE INDEX idx_service_featured ON service(featured);
CREATE INDEX idx_service_created_date ON service(created_date);
CREATE INDEX idx_service_updated_date ON service(updated_date);

-- currency

CREATE TABLE consultant_currency (
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  currency_id INT NOT NULL REFERENCES currency(id) ON DELETE CASCADE,
  PRIMARY KEY(consultant_id, currency_id)
);

--

CREATE TABLE gig_currency (
  gig_id INT NOT NULL REFERENCES gig(id) ON DELETE CASCADE,
  currency_id INT NOT NULL REFERENCES currency(id) ON DELETE CASCADE,
  PRIMARY KEY(gig_id, currency_id)
);

--

CREATE TABLE service_currency (
  service_id INT NOT NULL REFERENCES service(id) ON DELETE CASCADE,
  currency_id INT NOT NULL REFERENCES currency(id) ON DELETE CASCADE,
  PRIMARY KEY(service_id, currency_id)
);

-- category

CREATE TABLE consultant_category (
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(consultant_id, category_id)
);

--

CREATE TABLE blog_category (
  blog_id INT NOT NULL REFERENCES blog(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(blog_id, category_id)
);

--

CREATE TABLE gig_category (
  gig_id INT NOT NULL REFERENCES gig(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(gig_id, category_id)
);

--

CREATE TABLE service_category (
  service_id INT NOT NULL REFERENCES service(id) ON DELETE CASCADE,
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  PRIMARY KEY(service_id, category_id)
);

-- location

CREATE TABLE consultant_location (
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  location_id INT NOT NULL REFERENCES location(id) ON DELETE CASCADE,
  PRIMARY KEY(consultant_id, location_id)
);

--

CREATE TABLE gig_location (
  gig_id INT NOT NULL REFERENCES gig(id) ON DELETE CASCADE,
  location_id INT NOT NULL REFERENCES location(id) ON DELETE CASCADE,
  PRIMARY KEY(gig_id, location_id)
);

--

CREATE TABLE service_location (
  service_id INT NOT NULL REFERENCES service(id) ON DELETE CASCADE,
  location_id INT NOT NULL REFERENCES location(id) ON DELETE CASCADE,
  PRIMARY KEY(service_id, location_id)
);

-- favorite

CREATE TABLE consultant_favorite (
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  PRIMARY KEY(consultant_id, account_id)
);

--

CREATE TABLE blog_favorite (
  blog_id INT NOT NULL REFERENCES blog(id) ON DELETE CASCADE,
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  PRIMARY KEY(blog_id, account_id)
);

--

CREATE TABLE gig_favorite (
  gig_id INT NOT NULL REFERENCES gig(id) ON DELETE CASCADE,
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  PRIMARY KEY(gig_id, account_id)
);

--

CREATE TABLE service_favorite (
  service_id INT NOT NULL REFERENCES service(id) ON DELETE CASCADE,
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  PRIMARY KEY(service_id, account_id)
);

-- total

CREATE TABLE total (
  id SERIAL PRIMARY KEY,
  total_accounts INT NOT NULL DEFAULT 0,
  total_accounts_active INT NOT NULL DEFAULT 0,
  total_currencies INT NOT NULL DEFAULT 0,
  total_categories INT NOT NULL DEFAULT 0,
  total_locations INT NOT NULL DEFAULT 0,
  total_blogs INT NOT NULL DEFAULT 0,
  total_consultants INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0
);

--

CREATE TABLE consultant_total (
  consultant_id INT NOT NULL REFERENCES consultant(id) ON DELETE CASCADE,
  total_favorites INT NOT NULL DEFAULT 0,
  PRIMARY KEY(consultant_id)
);

--

CREATE INDEX idx_consultant_total_total_favorites ON consultant_total(total_favorites);

--

CREATE TABLE blog_total (
  blog_id INT NOT NULL REFERENCES blog(id) ON DELETE CASCADE,
  total_favorites INT NOT NULL DEFAULT 0,
  PRIMARY KEY(blog_id)
);

--

CREATE INDEX idx_blog_total_total_favorites ON blog_total(total_favorites);

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
  total_consultants INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(currency_id)
);

--

CREATE INDEX idx_currency_total_total_consultants ON currency_total(total_consultants);
CREATE INDEX idx_currency_total_total_gigs ON currency_total(total_gigs);
CREATE INDEX idx_currency_total_total_services ON currency_total(total_services);

--

CREATE TABLE category_total (
  category_id INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
  total_blogs INT NOT NULL DEFAULT 0,
  total_consultants INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(category_id)
);

--

CREATE INDEX idx_category_total_total_blogs ON category_total(total_blogs);
CREATE INDEX idx_category_total_total_consultants ON category_total(total_consultants);
CREATE INDEX idx_category_total_total_gigs ON category_total(total_gigs);
CREATE INDEX idx_category_total_total_services ON category_total(total_services);

--

CREATE TABLE location_total (
  location_id INT NOT NULL REFERENCES location(id) ON DELETE CASCADE,
  total_consultants INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(location_id)
);

--

CREATE INDEX idx_location_total_total_consultants ON location_total(total_consultants);
CREATE INDEX idx_location_total_total_gigs ON location_total(total_gigs);
CREATE INDEX idx_location_total_total_services ON location_total(total_services);

--

CREATE TABLE account_total (
  account_id INT NOT NULL REFERENCES account(id) ON DELETE CASCADE,
  total_blog_favorites INT NOT NULL DEFAULT 0,
  total_consultant_favorites INT NOT NULL DEFAULT 0,
  total_gig_favorites INT NOT NULL DEFAULT 0,
  total_service_favorites INT NOT NULL DEFAULT 0,
  total_blogs INT NOT NULL DEFAULT 0,
  total_gigs INT NOT NULL DEFAULT 0,
  total_services INT NOT NULL DEFAULT 0,
  PRIMARY KEY(account_id)
);

--

CREATE INDEX idx_account_total_total_blog_favorites ON account_total(total_blog_favorites);
CREATE INDEX idx_account_total_total_consultant_favorites ON account_total(total_consultant_favorites);
CREATE INDEX idx_account_total_total_gig_favorites ON account_total(total_gig_favorites);
CREATE INDEX idx_account_total_total_service_favorites ON account_total(total_service_favorites);
CREATE INDEX idx_account_total_total_blogs ON account_total(total_blogs);
CREATE INDEX idx_account_total_total_gigs ON account_total(total_gigs);
CREATE INDEX idx_account_total_total_services ON account_total(total_services);

-- create views

CREATE VIEW item_view
AS
SELECT account.id AS item_view_id, username, chat_online
FROM account
INNER JOIN account_active ON account.id = account_active.account_id;

--

CREATE VIEW consultant_view
AS
SELECT *
FROM consultant
INNER JOIN item_view ON consultant.account_id = item_view.item_view_id;

--

CREATE VIEW consultant_short_view
AS
SELECT consultant.id AS consultant_short_view_id, consultant.title AS consultant_title, consultant.title_url AS consultant_url, image_thumb, username, chat_online
FROM consultant
INNER JOIN item_view ON consultant.account_id = item_view.item_view_id;

--

CREATE VIEW blog_view
AS
SELECT *
FROM blog
INNER JOIN consultant_short_view ON blog.consultant_id = consultant_short_view.consultant_short_view_id;

--

CREATE VIEW gig_view
AS
SELECT *
FROM gig
INNER JOIN consultant_short_view ON gig.consultant_id = consultant_short_view.consultant_short_view_id;

--

CREATE VIEW service_view
AS
SELECT *
FROM service
INNER JOIN consultant_short_view ON service.consultant_id = consultant_short_view.consultant_short_view_id;
