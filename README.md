# FinancialDocs with Neuron AI and AWS S3

Web application for companies, where they can save, share or edit Financial documents. Neuron AI agent will provides analysis, statistic prevision and respond to questions like: 'How much i will spend the next month?'.

## Entity

### FinancialDocument

**Json structure where you can aslo upload files (they will be saved in AWS S3)**

### User

### API

**This project provides also API endpoint**

### Tests

**This project provides Feat and Unit tests**

## Functionality

### User

-   Profile interaction (reset password, logout ...).
-   Upload, edit or remove financial documents.
-   Export document in excel file

## Ai features

Workflow:

1. Utente carica / aggiorna i suoi financial_documents
2. Creo embedding e salvo i documenti nel vector store (
    - Quando salvo il document nel vector, li assegno id, un content con il contenuto e nei metadati l'user_id.
    - Il vector memorizza embedding, contenuto e metadata.
      )
3. Quando l'utente fa una domanda la RAG cerca i documenti più pertinenti e li passa all'agent
4. L'agent genera la risposta

### Rag

-   Custom rag with financial-documents of users.
-   Ai will recive the data from users and also relevant data for accurate response

## Tech Stack

-   Laravel
-   Liveire
-   Livewire UI
-   Neuron AI
-   Qdrant
