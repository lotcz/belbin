APP_DIR = $(shell pwd)
Z_VERSION = v3
Z_DIR = $(APP_DIR)/../zEngine

perms:
	chown -R www-data:www-data $(APP_DIR)/public
	chmod -R a+r $(APP_DIR)/public

pull:
	cd $(APP_DIR) && git pull

checkout:
	cd $(APP_DIR) && git checkout $(version)

z_update:
	cd $(Z_DIR) && make update

update: z_update pull perms

upgrade: pull checkout perms

install_z:
	git clone --depth 1 -b $(Z_VERSION) --single-branch https://github.com/lotcz/zEngine.git $(Z_DIR)

app_config:
	cp -R $(APP_DIR)/app/config/examples/. $(APP_DIR)/app/config

app_apache_install:
	cp $(APP_DIR)/install/belbin.conf /etc/apache2/sites-available
	sudo a2dissite 000-default.conf
	sudo a2ensite belbin.conf

install_app: app_config app_apache_install

install_db:
	cd $(APP_DIR)/install && php install.php --db_login="$(root_name)" --db_password="$(root_password)" --db_name="$(db_name)"

install_files: install_z install_app perms

install: install_files install_db

adduser:
	cd $(APP_DIR)/install && php adduser.php --visitor_email="$(visitor_email)" --visitor_password="$(visitor_password)" --admin_name="$(admin_name)" --admin_login="$(admin_login)" --admin_email="$(admin_email)" --admin_password="$(admin_password)"

prepare_test:
	cd $(APP_DIR)/tests && composer install

unit_test:
	cd $(Z_DIR) && make test
	cd $(APP_DIR) && phpunit --bootstrap tests/unit/autoload.php --testdox tests/unit

process_test:
	cd $(APP_DIR)/tests/process && mvn test

test: unit_test process_test
