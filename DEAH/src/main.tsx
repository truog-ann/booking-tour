
import ReactDOM from 'react-dom/client'
import App from './App.tsx'
import './index.css'
import { BrowserRouter } from 'react-router-dom'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'



const queryclient = new QueryClient();

ReactDOM.createRoot(document.getElementById('root')!).render(

    <QueryClientProvider client={queryclient}>

        <BrowserRouter>

            <App />

        </BrowserRouter>

    </QueryClientProvider>

)