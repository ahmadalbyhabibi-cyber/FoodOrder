# Food Order (PHP Native)

Minimal native PHP food ordering app based on the provided landing-page template.

Setup
1. Place the folder into `C:\xampp\htdocs\food_order`.
2. Create MySQL database and import `database.sql`:

```powershell
# from PowerShell (adjust path to mysql.exe if needed)
mysql -u root -p < database.sql
# or create DB then import
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS food_order;"
mysql -u root -p food_order < database.sql
```

3. Edit `config.php` if your DB credentials differ.
4. Open in browser: `http://localhost/food_order/`

Default admin user (from SQL):
- email: `admin@foodorder.test`
 - password: `password`

Notes
- This is minimal and intended for local development with XAMPP.
- For production, secure uploads, CSRF, prepared statements everywhere, and input validation are required.