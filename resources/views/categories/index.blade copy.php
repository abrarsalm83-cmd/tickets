@extends('layouts.app')

@section('content')
    <div class="content-section">
        <div class="section-header">
            <div class="section-title">Ticket Categories</div>
            <button class="btn btn-primary" onclick="showAddModal()">
                <span>➕</span>
                <span>Add Category</span>
            </button>
        </div>

        <div class="search-container">
            <input type="text" class="search-input" placeholder="🔍 Search ticket categories..."
                oninput="searchCategories(this.value)">
        </div>

        <div class="categories-grid" id="category-list">
            <!-- Categories will be populated by JavaScript -->
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal" id="categoryModal">
        <div class="modal-content">
            <div class="modal-title" id="modal-title">
                🎫 Add New Category
            </div>
            <form onsubmit="saveCategory(event)">
                <div class="form-group">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-input" id="categoryName"
                        placeholder="e.g., Concerts, Sports Events..." required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-input form-textarea" id="categoryDescription"
                        placeholder="Brief description of this ticket category..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Default Ticket Price ($)</label>
                    <input type="number" class="form-input" id="defaultPrice" placeholder="0.00" min="0"
                        step="0.01">
                </div>
                <div class="modal-buttons">
                    <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .search-container {
            margin-bottom: 24px;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            color: #1e293b;
            transition: all 0.2s ease;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 16px;
        }

        .category-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border-color: #3b82f6;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .category-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .category-description {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.4;
        }

        .category-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
        }

        .category-stat {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .stat-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .category-actions {
            display: flex;
            gap: 8px;
        }

        .category-btn {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 16px;
            padding: 8px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-btn:hover {
            background: #f8fafc;
            color: #3b82f6;
            transform: scale(1.1);
        }

        .category-btn.edit:hover {
            color: #059669;
        }

        .category-btn.delete:hover {
            color: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
            grid-column: 1 / -1;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state-text {
            font-size: 1.125rem;
            font-weight: 500;
            margin-bottom: 8px;
            color: #1e293b;
        }

        .empty-state-subtext {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 32px;
            border-radius: 12px;
            width: 500px;
            max-width: 90%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e7eb;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 24px;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #374151;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            color: #1e293b;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        @media (max-width: 768px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
                padding: 24px;
            }

            .modal-buttons {
                flex-direction: column;
            }
        }
    </style>

    <script>
        let categories = [];
        let editingId = null;
        let nextId = 1;

        // Initialize with sample ticket categories
        function initializeData() {
            categories = [{
                    id: 1,
                    name: 'Concert Tickets',
                    description: 'Music concerts and live performances',
                    ticketsSold: 1247,
                    defaultPrice: 45.00,
                    status: 'active'
                },
                {
                    id: 2,
                    name: 'Sports Events',
                    description: 'Football, basketball, and other sports',
                    ticketsSold: 892,
                    defaultPrice: 35.00,
                    status: 'active'
                },
                {
                    id: 3,
                    name: 'Theater Shows',
                    description: 'Drama, comedy, and musical theater',
                    ticketsSold: 634,
                    defaultPrice: 55.00,
                    status: 'active'
                },
                {
                    id: 4,
                    name: 'Conference Passes',
                    description: 'Business and tech conferences',
                    ticketsSold: 428,
                    defaultPrice: 125.00,
                    status: 'active'
                },
                {
                    id: 5,
                    name: 'Workshop Sessions',
                    description: 'Educational and training workshops',
                    ticketsSold: 312,
                    defaultPrice: 75.00,
                    status: 'active'
                },
                {
                    id: 6,
                    name: 'Comedy Shows',
                    description: 'Stand-up comedy and humor events',
                    ticketsSold: 156,
                    defaultPrice: 25.00,
                    status: 'active'
                }
            ];
            nextId = 7;
            renderCategories();
        }

        function renderCategories(filteredCategories = null) {
            const categoryList = document.getElementById('category-list');
            const categoriesToRender = filteredCategories || categories;

            if (categoriesToRender.length === 0) {
                categoryList.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">🎫</div>
                    <div class="empty-state-text">No ticket categories found</div>
                    <div class="empty-state-subtext">Create your first category to get started</div>
                </div>
            `;
                return;
            }

            categoryList.innerHTML = categoriesToRender.map(category => `
            <div class="category-card" data-id="${category.id}">
                <div class="category-header">
                    <div>
                        <div class="category-name">${category.name}</div>
                        <div class="category-description">${category.description || 'No description'}</div>
                    </div>
                    <div class="category-actions">
                        <button class="category-btn edit" onclick="editCategory(${category.id})" title="Edit Category">✏️</button>
                        <button class="category-btn delete" onclick="deleteCategory(${category.id})" title="Delete Category">🗑️</button>
                    </div>
                </div>
                <div class="category-stats">
                    <div class="category-stat">
                        <div class="stat-value">${category.ticketsSold}</div>
                        <div class="stat-label">Sold</div>
                    </div>
                    <div class="category-stat">
                        <div class="stat-value">$${category.defaultPrice.toFixed(2)}</div>
                        <div class="stat-label">Price</div>
                    </div>
                    <div class="category-stat">
                        <div class="stat-value">${category.status}</div>
                        <div class="stat-label">Status</div>
                    </div>
                </div>
            </div>
        `).join('');
        }

        function searchCategories(query) {
            if (!query.trim()) {
                renderCategories();
                return;
            }

            const filtered = categories.filter(category =>
                category.name.toLowerCase().includes(query.toLowerCase()) ||
                (category.description && category.description.toLowerCase().includes(query.toLowerCase()))
            );

            renderCategories(filtered);
        }

        function showAddModal() {
            editingId = null;
            document.getElementById('modal-title').innerHTML = '🎫 Add New Category';
            document.getElementById('categoryName').value = '';
            document.getElementById('categoryDescription').value = '';
            document.getElementById('defaultPrice').value = '';
            document.getElementById('categoryModal').classList.add('show');
            document.getElementById('categoryName').focus();
        }

        function editCategory(id) {
            const category = categories.find(c => c.id === id);
            if (!category) return;

            editingId = id;
            document.getElementById('modal-title').innerHTML = '✏️ Edit Category';
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description || '';
            document.getElementById('defaultPrice').value = category.defaultPrice || '';
            document.getElementById('categoryModal').classList.add('show');
            document.getElementById('categoryName').focus();
        }

        function saveCategory(event) {
            event.preventDefault();

            const name = document.getElementById('categoryName').value.trim();
            const description = document.getElementById('categoryDescription').value.trim();
            const defaultPrice = parseFloat(document.getElementById('defaultPrice').value) || 0;

            if (!name) return;

            if (editingId) {
                // Edit existing category
                const category = categories.find(c => c.id === editingId);
                if (category) {
                    category.name = name;
                    category.description = description;
                    category.defaultPrice = defaultPrice;
                }
            } else {
                // Add new category
                categories.push({
                    id: nextId++,
                    name: name,
                    description: description,
                    defaultPrice: defaultPrice,
                    ticketsSold: 0,
                    status: 'active'
                });
            }

            closeModal();
            renderCategories();

            // Show success message
            showNotification(editingId ? 'Category updated successfully!' : 'New category created!');
        }

        function deleteCategory(id) {
            const category = categories.find(c => c.id === id);
            if (!category) return;

            const hasTickets = category.ticketsSold > 0;
            const message = hasTickets ?
                `Are you sure you want to delete "${category.name}"? This category has ${category.ticketsSold} tickets sold.` :
                `Are you sure you want to delete "${category.name}"?`;

            if (confirm(message)) {
                categories = categories.filter(c => c.id !== id);
                renderCategories();
                showNotification('Category deleted successfully!');
            }
        }

        function closeModal() {
            document.getElementById('categoryModal').classList.remove('show');
            editingId = null;
        }

        function showNotification(message) {
            // Simple notification system
            const notification = document.createElement('div');
            notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #059669;
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #10b981;
        `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Close modal when clicking outside
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Initialize the application
        initializeData();
    </script>
@endsection
