<div class="sidebar">

    <h2>
        <i class="fas fa-box"></i>
        Storage System
    </h2>

    <a href="dashboard.php">
        <i class="fas fa-chart-line"></i>
        Dashboard
    </a>

    <a href="items.php">
        <i class="fas fa-boxes"></i>
        Items
    </a>

    <a href="categories.php">
        <i class="fas fa-tags"></i>
        Categories
    </a>

    <a href="suppliers.php">
        <i class="fas fa-truck"></i>
        Suppliers
    </a>

    <a href="../logout.php"
   onclick="return confirm('Are you sure you want to log out?');">
    <i class="fas fa-right-from-bracket"></i>
    Logout
    </a>

    <!-- ====== THEME TOGGLE SWITCH ====== -->
    <div style="margin-top: 30px; border-top: 1px solid #374151; padding-top: 20px; display: flex; align-items: center; justify-content: space-between;">
        <span style="color: #9ca3af; font-size: 14px;">
            <i class="fas fa-moon" id="themeIconSmall" style="margin-right: 5px;"></i> Theme
        </span>

        <label class="theme-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
            <input type="checkbox" id="themeToggle" style="opacity: 0; width: 0; height: 0;">
            <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #4b5563; transition: .4s; border-radius: 24px;"></span>
            <span style="position: absolute; cursor: pointer; content: ''; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%;"></span>
            <i class="fas fa-sun" style="position: absolute; left: 5px; top: 4px; color: #fbbf24; font-size: 12px; pointer-events: none;"></i>
            <i class="fas fa-moon" style="position: absolute; right: 5px; top: 4px; color: #e5e7eb; font-size: 12px; pointer-events: none;"></i>
        </label>
    </div>

</div> 