# TravelNest - Enterprise-Grade Travel Agency Platform

An enterprise-ready, fully responsive React 19 + Vite 7 application migrating the original static HTML travel agency layout into a modern SPA (Single Page Application).

## Technology Stack

* **Core:** React 19 (Functional Components, ES2024+, Hooks), Vite 7
* **Routing:** React Router DOM (v7)
* **API Ingestion:** Axios
* **Form & Validation:** React Hook Form + Zod
* **Styling:** CSS3 variables, layout flexbox/grid models (excluding Tailwind CSS)
* **Animation & Visuals:** Framer Motion, Swiper.js, React Icons, React Loading Skeleton
* **SEO & Analytics:** React Helmet Async, Chart.js, react-chartjs-2, TanStack React Table
* **Notifications & Helpers:** React Hot Toast, Day.js, clsx

---

## Folder Structure

```
travel-agency-react/
├── public/                  # Static assets (images, logos, robots.txt, sitemap.xml)
├── src/
│   ├── assets/              # App fonts, local SVGs, animations
│   ├── styles/              # Global variables, typography, layouts, animations
│   ├── components/          # Reusable shared & section-specific components
│   ├── layouts/             # Page layouts (Main, Auth, Dashboard, Admin)
│   ├── pages/               # Main website routes & dashboards
│   ├── routes/              # Route configs (Public, Private, Admin)
│   ├── hooks/               # Custom lifecycle hooks
│   ├── context/             # Global Context API state managers
│   ├── services/            # Axios API configurations & resource handlers
│   ├── utils/               # Helper formats, validators, date helpers
│   ├── constants/           # Global app constants
│   ├── data/                # Static mock data stores
│   ├── App.jsx              # Application root
│   └── main.jsx             # React DOM renderer entry
├── package.json             # Core dependencies configuration
├── vite.config.js           # Vite builds & alias resolutions
├── eslint.config.js         # ESLint 9 configuration
└── jsconfig.json            # Editor path resolution helper
```

---

## Installation & Running Locally

1. Install project dependencies:
   ```bash
   npm install --legacy-peer-deps
   ```

2. Start the development server:
   ```bash
   npm run dev
   ```

3. Build for production:
   ```bash
   npm run build
   ```

4. Preview the production build:
   ```bash
   npm run preview
   ```
