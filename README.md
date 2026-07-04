# ⏰ crone-jobs

<p align="center">
  <img src="https://img.shields.io/github/stars/Alok345/crone-jobs?style=for-the-badge&logo=github&color=F1C40F&logoColor=white" alt="Stars" />
  <img src="https://img.shields.io/github/forks/Alok345/crone-jobs?style=for-the-badge&logo=github-owners&color=007ACC&logoColor=white" alt="Forks" />
  <img src="https://img.shields.io/github/issues/Alok345/crone-jobs?style=for-the-badge&logo=gitbook&color=E74C3C&logoColor=white" alt="Issues" />
  <img src="https://img.shields.io/github/license/Alok345/crone-jobs?style=for-the-badge&logo=clojure&color=2ECC71&logoColor=white" alt="License" />
</p>

<p align="center">
  <strong>A premium, lightning-fast, and robust distributed cron job scheduler and management dashboard.</strong>
  <br />
  Designed to schedule, orchestrate, monitor, and debug time-based background tasks with absolute precision and elegance.
</p>

---

## 📖 Table of Contents
1. [Introduction](#-introduction)
2. [Features](#-features)
3. [Tech Stack](#-tech-stack)
4. [Project Structure](#-project-structure)
5. [Getting Started](#-getting-started)
   - [Prerequisites](#prerequisites)
   - [Environment Setup](#environment-setup)
   - [Installation](#installation)
6. [Usage & Configuration](#-usage--configuration)
7. [API Documentation](#-api-documentation)
8. [Roadmap](#-roadmap)
9. [Contributing](#-contributing)
10. [License](#-license)

---

## 🌟 Introduction

**crone-jobs** is an enterprise-grade background task orchestrator and cron scheduling engine designed to eliminate the complexity of running and monitoring scheduled jobs. Built on top of Node.js, Redis, and React, it provides an intuitive web interface combined with a highly available, fault-tolerant execution engine. 

Whether you need to trigger daily backups, send weekly newsletters, run continuous database cleanups, or orchestrate highly sensitive financial transactions, `crone-jobs` delivers millisecond-level precision, dynamic scaling, and complete visibility.

---

## ✨ Features

- **⚡ High-Performance Scheduler**: Built on BullMQ & Redis, handling millions of jobs without blocking the main event loop.
- **🖥️ Interactive Web Dashboard**: Real-time visualization of job status (Active, Waiting, Completed, Failed, Delayed).
- **🔄 Fault Tolerance & Retries**: Automated back-off retries, rate-limiting, and concurrency control.
- **📊 Real-time Metrics**: Live performance logging, CPU usage, RAM utilization, and success/failure ratios.
- **🔔 Instant Notifications**: Built-in alerting system integrated with Slack, Discord, and Email webhooks.
- **🔒 Role-Based Access Control (RBAC)**: Secure access to the dashboard with administrative controls.
- **🐳 Docker Ready**: Seamless local setup and deployment with multi-stage Docker configurations.

---

## 🛠️ Tech Stack

### Frontend & Dashboard
![](https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB)
![](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![](https://img.shields.io/badge/TypeScript-007ACC?style=for-the-badge&logo=typescript&logoColor=white)

### Backend Engine
![](https://img.shields.io/badge/Node.js-339933?style=for-the-badge&logo=nodedotjs&logoColor=white)
![](https://img.shields.io/badge/Express-000000?style=for-the-badge&logo=express&logoColor=white)
![](https://img.shields.io/badge/BullMQ-D22128?style=for-the-badge&logo=bull&logoColor=white)
![](https://img.shields.io/badge/Prisma-2D3748?style=for-the-badge&logo=prisma&logoColor=white)

### Infrastructure & Database
![](https://img.shields.io/badge/Redis-DC382D?style=for-the-badge&logo=redis&logoColor=white)
![](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

---

## 📂 Project Structure

This project is architected as a clean monorepo, keeping the scheduler logic completely separate from the monitoring UI.

```bash
crone-jobs/
├── apps/
│   ├── api/                  # Express & BullMQ Background Worker Engine
│   │   ├── src/
│   │   │   ├── config/       # Redis, Database & Queue configurations
│   │   │   ├── jobs/         # Task-specific business logic definition
│   │   │   ├── middleware/   # Authentication, logging, and error handling
│   │   │   ├── routes/       # API endpoints for task CRUD operations
│   │   │   ├── workers/      # BullMQ queue workers
│   │   │   └── index.ts      # Server entry point
│   │   ├── package.json
│   │   └── tsconfig.json
│   │
│   └── web/                  # Vite-powered React UI Dashboard
│       ├── src/
│       │   ├── components/   # Reusable UI parts (Charts, Tables, Job Modals)
│       │   ├── hooks/        # Custom React hooks for API state management
│       │   ├── pages/        # Dashboard, Analytics, Logs, and Settings
│       │   └── main.tsx      # React entry point
│       ├── tailwind.config.js
│       └── package.json
│
├── docker-compose.yml        # Orchestration file for PostgreSQL, Redis, and Services
├── package.json              # Workspace root manifest
└── README.md
```

---

## 🚀 Getting Started

Follow these steps to run the complete environment locally.

### Prerequisites
Make sure you have the following tools installed globally:
- [Node.js](https://nodejs.org/) (v18.x or above recommended)
- [npm](https://www.npmjs.com/) or [pnpm](https://pnpm.io/)
- [Docker & Docker Compose](https://www.docker.com/)

---

### Environment Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Alok345/crone-jobs.git
   cd crone-jobs
   ```

2. **Create local environment files:**
   
   Create a `.env` file in the root directory:
   ```env
   # API Settings
   PORT=5000
   NODE_ENV=development

   # Database (PostgreSQL)
   DATABASE_URL="postgresql://postgres:postgres@localhost:5432/crone_jobs?schema=public"

   # Redis Configuration
   REDIS_HOST="localhost"
   REDIS_PORT=6379

   # Security
   JWT_SECRET="super-secret-security-key-change-me"
   ```

---

### Installation

To spin up the external infrastructure (Database & Redis queue) and install package dependencies:

1. **Spin up PostgreSQL & Redis via Docker:**
   ```bash
   docker-compose up -d
   ```

2. **Install Root and Workspace Dependencies:**
   ```bash
   pnpm install
   # or
   npm install
   ```

3. **Run Database Migrations:**
   ```bash
   pnpm --filter api run prisma:migrate
   ```

4. **Start Development Servers (API & Web Dashboard concurrently):**
   ```bash
   pnpm dev
   # or
   npm run dev
   ```

Your browser should automatically open `http://localhost:5173` pointing to the web dashboard, while the backend API runs on `http://localhost:5000`.

---

## 💻 Usage & Configuration

Adding a cron job programmatically is straightforward. Here is an example of setting up a recurring scheduled task:

```typescript
import { Queue, Worker } from 'bullmq';

// 1. Initialize your Queue
const emailQueue = new Queue('EmailBillingQueue', {
  connection: { host: 'localhost', port: 6379 }
});

// 2. Schedule a repeatable cron job (Runs every day at midnight)
await emailQueue.add('SendDailyInvoices', { userId: 'all' }, {
  repeat: {
    pattern: '0 0 * * *' // Standard Cron Syntax
  }
});

// 3. Define Worker to process tasks
const emailWorker = new Worker('EmailBillingQueue', async job => {
  console.log(`Starting invoice generation for: ${job.data.userId}`);
  // Implement invoice generation and email logic here
}, {
  connection: { host: 'localhost', port: 6379 }
});
```

---

## 🔌 API Documentation

All cron jobs can be created, updated, and triggered dynamically via REST endpoints.

| Method | Endpoint | Description | Payload Example |
| :--- | :--- | :--- | :--- |
| **GET** | `/api/v1/jobs` | Retrieve all scheduled jobs | N/A |
| **POST** | `/api/v1/jobs/create` | Schedule a new cron job | `{ "name": "Backup", "cron": "0 12 * * *", "data": {} }` |
| **POST** | `/api/v1/jobs/:id/trigger` | Manually run a job immediately | N/A |
| **PATCH** | `/api/v1/jobs/:id/pause` | Pause an active scheduler | N/A |
| **DELETE** | `/api/v1/jobs/:id` | Cancel and delete scheduled cron | N/A |

---

## 🗺️ Roadmap

- [ ] Support for **GraphQL** subscriptions on real-time execution graphs.
- [ ] Direct integration with **Kubernetes CronJobs**.
- [ ] Exportable analytics reports (PDF/CSV) with performance overhead diagnostics.
- [ ] SMS Alert integrations via Twilio.

---

## 🤝 Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

---

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

---

<p align="center">
  Developed with ❤️ by <a href="https://github.com/Alok345">Alok345</a>
</p>