# QuickStats - Moodle Plugin

**QuickStats** is a local plugin for Moodle that provides administrators with insights into active user statistics over a specified period (e.g., the last N days). The plugin offers an easy-to-use interface, an interactive chart displaying recent trends, and options for automatic or manual data updates.

---

## Features

- Displays the number of active users within a configurable time period.
- Interactive chart showing trends of active users.
- Automatic data updates via a scheduled task or manual updates via the dashboard.
- AJAX-based data retrieval for charts using Moodle's external API structure.
- Full integration with Moodle Core APIs and XMLDB standards.
- Configurable settings available in the admin panel.

---

## System Requirements

- **Moodle**: Version 4.5 or later.
- **PHP**: Version 7.4 or later.
- **Database**: MySQL, MariaDB, PostgreSQL, or any Moodle-supported database.

---

## Installation

1. **Download**

   - Clone or download this repository: https://github.com/malinai9/quickstats

2. **Place in the Moodle directory**

   - Copy the `quickstats` folder to Moodle's `local/` directory:
     ```bash
     moodle/local/quickstats/
     ```

3. **Install the plugin**

   - Log in to Moodle as an administrator.
   - Navigate to **Site administration > Notifications**.
   - Follow the steps to complete the installation.

4. **Verify installation**
   - Go to **Site administration > Plugins > Local plugins > QuickStats** to configure the plugin.

---

## Configuration

1. **Enable the plugin**

   - Navigate to **Site administration > Plugins > Local plugins > QuickStats > Settings**.
   - Enable the **QuickStats** option.

2. **Set the active days threshold**

   - Define the number of days to consider a user as "active" (e.g., 7 days).

3. **Schedule automatic updates**
   - By default, the scheduled task runs daily at 2:00 AM. This can be adjusted under **Site administration > Server > Tasks > Scheduled tasks**.

---

## Usage

1. **View statistics**

   - Navigate to **Site administration > Plugins > Local plugins > QuickStats**.
   - You will see:
     - The current number of active users.
     - A chart showing recent trends of active users.

2. **Manual update**

   - Click the **Refresh data** button to manually update statistics.

3. **Interactive Chart**
   - The plugin uses AJAX calls via the `get_chart_data` external class to fetch and display chart data dynamically.

---

## Development

### Directory Structure

```plaintext
local/
└── quickstats/
    ├── db/
    │   ├── install.xml       # Database table definition
    │   ├── services.php      # External API configuration
    │   ├── tasks.php         # Scheduled task configuration
    ├── lang/
    │   └── en/
    │       └── local_quickstats.php   # Language strings for English
    ├── classes/
    │   ├── task/
    │   │   └── update_stats_task.php  # Scheduled task logic
    │   └── external/
    │       └── get_chart_data.php     # External API for chart data
    ├── amd/
    │   └── src/
    │       └── chart.js       # Chart logic
    ├── settings.php           # Plugin settings
    ├── styles.css             # Styles settings
    ├── index.php              # Main plugin page
    ├── version.php            # Plugin version file
    ├── README.md              # Documentation
```
