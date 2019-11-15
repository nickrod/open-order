-- functions

-- account

CREATE OR REPLACE FUNCTION account()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'account') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_accounts = total_accounts + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_accounts = total_accounts - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'account_active') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_accounts_active = total_accounts_active + 1 WHERE id = 1;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_accounts_active = total_accounts_active - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- tag

CREATE OR REPLACE FUNCTION tag()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'currency') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_currencies = total_currencies + 1 WHERE id = 1;
      INSERT INTO currency_price (currency_id) VALUES (NEW.id);
      INSERT INTO currency_total (currency_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_currencies = total_currencies - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'category') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_categories = total_categories + 1 WHERE id = 1;
      INSERT INTO category_total (category_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_categories = total_categories - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'location') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_locations = total_locations + 1 WHERE id = 1;
      INSERT INTO location_total (location_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_locations = total_locations - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- item

CREATE OR REPLACE FUNCTION item()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'blog') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_blogs = total_blogs + 1 WHERE id = 1;
      UPDATE account_total SET total_blogs = total_blogs + 1 WHERE consultant_id = NEW.consultant_id;
      INSERT INTO blog_total (blog_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_blogs = total_blogs - 1 WHERE id = 1;
      UPDATE account_total SET total_blogs = total_blogs - 1 WHERE consultant_id = OLD.consultant_id;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'consultant') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_consultants = total_consultants + 1 WHERE id = 1;
      INSERT INTO account_total (consultant_id) VALUES (NEW.id);
      INSERT INTO consultant_total (consultant_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_consultants = total_consultants - 1 WHERE id = 1;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'gig') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_gigs = total_gigs + 1 WHERE id = 1;
      UPDATE account_total SET total_gigs = total_gigs + 1 WHERE consultant_id = NEW.consultant_id;
      INSERT INTO gig_total (gig_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_gigs = total_gigs - 1 WHERE id = 1;
      UPDATE account_total SET total_gigs = total_gigs - 1 WHERE consultant_id = OLD.consultant_id;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  ELSIF (TG_TABLE_NAME = 'service') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE total SET total_services = total_services + 1 WHERE id = 1;
      UPDATE account_total SET total_services = total_services + 1 WHERE consultant_id = NEW.consultant_id;
      INSERT INTO service_total (service_id) VALUES (NEW.id);
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE total SET total_services = total_services - 1 WHERE id = 1;
      UPDATE account_total SET total_services = total_services - 1 WHERE consultant_id = OLD.consultant_id;
      RETURN OLD;
    ELSIF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- currency price

CREATE OR REPLACE FUNCTION currency_price()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'currency_price') THEN
    IF (TG_OP = 'UPDATE') THEN
      NEW.updated_date = NOW();
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- item currency

CREATE OR REPLACE FUNCTION item_currency()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'consultant_currency') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE currency_total SET total_consultants = total_consultants + 1 WHERE currency_id = NEW.currency_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE currency_total SET total_consultants = total_consultants - 1 WHERE currency_id = OLD.currency_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'gig_currency') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE currency_total SET total_gigs = total_gigs + 1 WHERE currency_id = NEW.currency_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE currency_total SET total_gigs = total_gigs - 1 WHERE currency_id = OLD.currency_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'service_currency') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE currency_total SET total_services = total_services + 1 WHERE currency_id = NEW.currency_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE currency_total SET total_services = total_services - 1 WHERE currency_id = OLD.currency_id;
      RETURN OLD;
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- item category

CREATE OR REPLACE FUNCTION item_category()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'blog_category') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE category_total SET total_blogs = total_blogs + 1 WHERE category_id = NEW.category_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE category_total SET total_blogs = total_blogs - 1 WHERE category_id = OLD.category_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'consultant_category') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE category_total SET total_consultants = total_consultants + 1 WHERE category_id = NEW.category_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE category_total SET total_consultants = total_consultants - 1 WHERE category_id = OLD.category_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'gig_category') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE category_total SET total_gigs = total_gigs + 1 WHERE category_id = NEW.category_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE category_total SET total_gigs = total_gigs - 1 WHERE category_id = OLD.category_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'service_category') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE category_total SET total_services = total_services + 1 WHERE category_id = NEW.category_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE category_total SET total_services = total_services - 1 WHERE category_id = OLD.category_id;
      RETURN OLD;
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- item location

CREATE OR REPLACE FUNCTION item_location()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'consultant_location') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE location_total SET total_consultants = total_consultants + 1 WHERE location_id = NEW.location_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE location_total SET total_consultants = total_consultants - 1 WHERE location_id = OLD.location_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'gig_location') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE location_total SET total_gigs = total_gigs + 1 WHERE location_id = NEW.location_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE location_total SET total_gigs = total_gigs - 1 WHERE location_id = OLD.location_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'service_location') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE location_total SET total_services = total_services + 1 WHERE location_id = NEW.location_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE location_total SET total_services = total_services - 1 WHERE location_id = OLD.location_id;
      RETURN OLD;
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- item favorite

CREATE OR REPLACE FUNCTION item_favorite()
RETURNS trigger AS
$BODY$
BEGIN
  IF (TG_TABLE_NAME = 'blog_favorite') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE blog_total SET total_favorites = total_favorites + 1 WHERE blog_id = NEW.blog_id;
      UPDATE account_total SET total_blog_favorites = total_blog_favorites + 1 WHERE account_id = NEW.account_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE blog_total SET total_favorites = total_favorites - 1 WHERE blog_id = OLD.blog_id;
      UPDATE account_total SET total_blog_favorites = total_blog_favorites - 1 WHERE account_id = OLD.account_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'consultant_favorite') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE consultant_total SET total_favorites = total_favorites + 1 WHERE consultant_id = NEW.consultant_id;
      UPDATE account_total SET total_consultant_favorites = total_consultant_favorites + 1 WHERE account_id = NEW.account_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE consultant_total SET total_favorites = total_favorites - 1 WHERE consultant_id = OLD.consultant_id;
      UPDATE account_total SET total_consultant_favorites = total_consultant_favorites - 1 WHERE account_id = OLD.account_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'gig_favorite') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE gig_total SET total_favorites = total_favorites + 1 WHERE gig_id = NEW.gig_id;
      UPDATE account_total SET total_gig_favorites = total_gig_favorites + 1 WHERE account_id = NEW.account_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE gig_total SET total_favorites = total_favorites - 1 WHERE gig_id = OLD.gig_id;
      UPDATE account_total SET total_gig_favorites = total_gig_favorites - 1 WHERE account_id = OLD.account_id;
      RETURN OLD;
    END IF;
  ELSIF (TG_TABLE_NAME = 'service_favorite') THEN
    IF (TG_OP = 'INSERT') THEN
      UPDATE service_total SET total_favorites = total_favorites + 1 WHERE service_id = NEW.service_id;
      UPDATE account_total SET total_service_favorites = total_service_favorites + 1 WHERE account_id = NEW.account_id;
    ELSIF (TG_OP = 'DELETE') THEN
      UPDATE service_total SET total_favorites = total_favorites - 1 WHERE service_id = OLD.service_id;
      UPDATE account_total SET total_service_favorites = total_service_favorites - 1 WHERE account_id = OLD.account_id;
      RETURN OLD;
    END IF;
  END IF;
  RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

-- triggers

-- account

DROP TRIGGER IF EXISTS account_insert ON account;
DROP TRIGGER IF EXISTS account_delete ON account;
DROP TRIGGER IF EXISTS account_update ON account;
DROP TRIGGER IF EXISTS account_active_insert ON account_active;
DROP TRIGGER IF EXISTS account_active_delete ON account_active;
DROP TRIGGER IF EXISTS account_active_update ON account_active;

--

CREATE TRIGGER account_insert BEFORE INSERT ON account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER account_delete BEFORE DELETE ON account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER account_update BEFORE UPDATE ON account FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER account_active_insert BEFORE INSERT ON account_active FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER account_active_delete BEFORE DELETE ON account_active FOR EACH ROW EXECUTE PROCEDURE account();
CREATE TRIGGER account_active_update BEFORE UPDATE ON account_active FOR EACH ROW EXECUTE PROCEDURE account();

-- tag

DROP TRIGGER IF EXISTS currency_insert ON currency;
DROP TRIGGER IF EXISTS currency_delete ON currency;
DROP TRIGGER IF EXISTS currency_update ON currency;
DROP TRIGGER IF EXISTS category_insert ON category;
DROP TRIGGER IF EXISTS category_delete ON category;
DROP TRIGGER IF EXISTS category_update ON category;
DROP TRIGGER IF EXISTS location_insert ON location;
DROP TRIGGER IF EXISTS location_delete ON location;
DROP TRIGGER IF EXISTS location_update ON location;

--

CREATE TRIGGER currency_insert AFTER INSERT ON currency FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER currency_delete BEFORE DELETE ON currency FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER currency_update BEFORE UPDATE ON currency FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER category_insert AFTER INSERT ON category FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER category_delete BEFORE DELETE ON category FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER category_update BEFORE UPDATE ON category FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER location_insert AFTER INSERT ON location FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER location_delete BEFORE DELETE ON location FOR EACH ROW EXECUTE PROCEDURE tag();
CREATE TRIGGER location_update BEFORE UPDATE ON location FOR EACH ROW EXECUTE PROCEDURE tag();

-- item

DROP TRIGGER IF EXISTS blog_insert ON blog;
DROP TRIGGER IF EXISTS blog_delete ON blog;
DROP TRIGGER IF EXISTS blog_update ON blog;
DROP TRIGGER IF EXISTS consultant_insert ON consultant;
DROP TRIGGER IF EXISTS consultant_delete ON consultant;
DROP TRIGGER IF EXISTS consultant_update ON consultant;
DROP TRIGGER IF EXISTS gig_insert ON gig;
DROP TRIGGER IF EXISTS gig_delete ON gig;
DROP TRIGGER IF EXISTS gig_update ON gig;
DROP TRIGGER IF EXISTS service_insert ON service;
DROP TRIGGER IF EXISTS service_delete ON service;
DROP TRIGGER IF EXISTS service_update ON service;

--

CREATE TRIGGER blog_insert AFTER INSERT ON blog FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER blog_delete BEFORE DELETE ON blog FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER blog_update BEFORE UPDATE ON blog FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER consultant_insert AFTER INSERT ON consultant FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER consultant_delete BEFORE DELETE ON consultant FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER consultant_update BEFORE UPDATE ON consultant FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER gig_insert AFTER INSERT ON gig FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER gig_delete BEFORE DELETE ON gig FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER gig_update BEFORE UPDATE ON gig FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER service_insert AFTER INSERT ON service FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER service_delete BEFORE DELETE ON service FOR EACH ROW EXECUTE PROCEDURE item();
CREATE TRIGGER service_update BEFORE UPDATE ON service FOR EACH ROW EXECUTE PROCEDURE item();

-- currency price

DROP TRIGGER IF EXISTS currency_price_update ON currency_price;

--

CREATE TRIGGER currency_price_update BEFORE UPDATE ON currency_price FOR EACH ROW EXECUTE PROCEDURE currency_price();

-- item currency

DROP TRIGGER IF EXISTS consultant_currency_insert ON consultant_currency;
DROP TRIGGER IF EXISTS consultant_currency_delete ON consultant_currency;
DROP TRIGGER IF EXISTS gig_currency_insert ON gig_currency;
DROP TRIGGER IF EXISTS gig_currency_delete ON gig_currency;
DROP TRIGGER IF EXISTS service_currency_insert ON service_currency;
DROP TRIGGER IF EXISTS service_currency_delete ON service_currency;

--

CREATE TRIGGER consultant_currency_insert BEFORE INSERT ON consultant_currency FOR EACH ROW EXECUTE PROCEDURE item_currency();
CREATE TRIGGER consultant_currency_delete BEFORE DELETE ON consultant_currency FOR EACH ROW EXECUTE PROCEDURE item_currency();
CREATE TRIGGER gig_currency_insert BEFORE INSERT ON gig_currency FOR EACH ROW EXECUTE PROCEDURE item_currency();
CREATE TRIGGER gig_currency_delete BEFORE DELETE ON gig_currency FOR EACH ROW EXECUTE PROCEDURE item_currency();
CREATE TRIGGER service_currency_insert BEFORE INSERT ON service_currency FOR EACH ROW EXECUTE PROCEDURE item_currency();
CREATE TRIGGER service_currency_delete BEFORE DELETE ON service_currency FOR EACH ROW EXECUTE PROCEDURE item_currency();

-- item category

DROP TRIGGER IF EXISTS blog_category_insert ON blog_category;
DROP TRIGGER IF EXISTS blog_category_delete ON blog_category;
DROP TRIGGER IF EXISTS consultant_category_insert ON consultant_category;
DROP TRIGGER IF EXISTS consultant_category_delete ON consultant_category;
DROP TRIGGER IF EXISTS gig_category_insert ON gig_category;
DROP TRIGGER IF EXISTS gig_category_delete ON gig_category;
DROP TRIGGER IF EXISTS service_category_insert ON service_category;
DROP TRIGGER IF EXISTS service_category_delete ON service_category;

--

CREATE TRIGGER blog_category_insert BEFORE INSERT ON blog_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER blog_category_delete BEFORE DELETE ON blog_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER consultant_category_insert BEFORE INSERT ON consultant_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER consultant_category_delete BEFORE DELETE ON consultant_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER gig_category_insert BEFORE INSERT ON gig_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER gig_category_delete BEFORE DELETE ON gig_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER service_category_insert BEFORE INSERT ON service_category FOR EACH ROW EXECUTE PROCEDURE item_category();
CREATE TRIGGER service_category_delete BEFORE DELETE ON service_category FOR EACH ROW EXECUTE PROCEDURE item_category();

-- item location

DROP TRIGGER IF EXISTS consultant_location_insert ON consultant_location;
DROP TRIGGER IF EXISTS consultant_location_delete ON consultant_location;
DROP TRIGGER IF EXISTS gig_location_insert ON gig_location;
DROP TRIGGER IF EXISTS gig_location_delete ON gig_location;
DROP TRIGGER IF EXISTS service_location_insert ON service_location;
DROP TRIGGER IF EXISTS service_location_delete ON service_location;

--

CREATE TRIGGER consultant_location_insert BEFORE INSERT ON consultant_location FOR EACH ROW EXECUTE PROCEDURE item_location();
CREATE TRIGGER consultant_location_delete BEFORE DELETE ON consultant_location FOR EACH ROW EXECUTE PROCEDURE item_location();
CREATE TRIGGER gig_location_insert BEFORE INSERT ON gig_location FOR EACH ROW EXECUTE PROCEDURE item_location();
CREATE TRIGGER gig_location_delete BEFORE DELETE ON gig_location FOR EACH ROW EXECUTE PROCEDURE item_location();
CREATE TRIGGER service_location_insert BEFORE INSERT ON service_location FOR EACH ROW EXECUTE PROCEDURE item_location();
CREATE TRIGGER service_location_delete BEFORE DELETE ON service_location FOR EACH ROW EXECUTE PROCEDURE item_location();

-- item favorite

DROP TRIGGER IF EXISTS blog_favorite_insert ON blog_favorite;
DROP TRIGGER IF EXISTS blog_favorite_delete ON blog_favorite;
DROP TRIGGER IF EXISTS consultant_favorite_insert ON consultant_favorite;
DROP TRIGGER IF EXISTS consultant_favorite_delete ON consultant_favorite;
DROP TRIGGER IF EXISTS gig_favorite_insert ON gig_favorite;
DROP TRIGGER IF EXISTS gig_favorite_delete ON gig_favorite;
DROP TRIGGER IF EXISTS service_favorite_insert ON service_favorite;
DROP TRIGGER IF EXISTS service_favorite_delete ON service_favorite;

--

CREATE TRIGGER blog_favorite_insert BEFORE INSERT ON blog_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER blog_favorite_delete BEFORE DELETE ON blog_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER consultant_favorite_insert BEFORE INSERT ON consultant_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER consultant_favorite_delete BEFORE DELETE ON consultant_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER gig_favorite_insert BEFORE INSERT ON gig_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER gig_favorite_delete BEFORE DELETE ON gig_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER service_favorite_insert BEFORE INSERT ON service_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
CREATE TRIGGER service_favorite_delete BEFORE DELETE ON service_favorite FOR EACH ROW EXECUTE PROCEDURE item_favorite();
