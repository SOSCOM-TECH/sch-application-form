Team Review + Task Distribution
Overall Instruction (For All Three)

All team members must:

Review the entire project end-to-end (routes, controllers, models, permissions, UI, security, structure).

Identify weaknesses—code smells, bad practices, missing validations, UX issues, performance issues, security gaps, poor file structure, repeated code, etc.

Document the issues in a shared list before starting fixes.

After the review, proceed with tasks as divided below.

Task Division
1. Gadafi – Backend Architecture & Security

Focus on everything behind the scenes:

Validate all forms and API requests

Check database structure

Fix weak logic or unoptimized queries

Improve role/permission implementation

Strengthen authentication and authorization

Clean controllers and move logic to Services where needed

Improve error handling

Ensure admin vs representative logic flows correctly

Target: Solid backend, secure, clean, scalable.

2. Jovin – Landing Page & Public-Facing UI

Jovin is responsible for all landing page improvements plus general frontend review:

Improve landing page UI/UX

Make the site more modern, faster, cleaner

Optimize responsiveness

Fix template inconsistencies

Improve accessibility

Refactor messy Blade templates

Ensure CSS/JS is optimized and not bloated

Improve SEO tags and meta

Target: High-quality public UI, professional look, optimized performance.

3. Bunango – Dashboard & Workflows

Focus entirely on internal user experience:

Improve dashboard structure

Review and fix navigation, components, layouts

Clean up HTML/Blade structure

Standardize UI elements

Improve forms (edit, create, publish, manage schools, etc.)

Fix slow or confusing parts in user flows

Organize assets

Ensure mobile-friendliness

Target: Clean dashboard experience, smooth workflows, maintainable UI code.

Output Expected From Each Developer

Each dev must produce:

A documented list of weaknesses found during review

Fixes implemented

Before/After explanation (short and clear)

Pull request with clean commits

1. clone the project
2. ⁠run composer install
3. ⁠run npm run dev
4. ⁠php artisan migrate
5. ⁠php artisan db:seed
6. ⁠npm run dev
7. ⁠php artisan serve

email: admin@example.com
psw: password
