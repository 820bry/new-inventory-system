# new-inventory-system

# TODO
- Redo Login page (because it's terrible)
- Inventory management
- ~~Register items~~
- ~~Update item info~~
- ~~Item reporting~~
- ~~Deleting items~~
- View report
- Export report as PDF (optional)
- Search inventory

# Known Problems
- If you delete an item, the ID sequence may get scrambled. E.g., if A001 was deleted but A002 & A003 was not, the next ID generated would still be A003 because there are only 2 items in the database.
- ~~Weird positioning thing in inventory.php with the banner and popup window~~
- ~~Fix formatting for reports row in inventory data~~