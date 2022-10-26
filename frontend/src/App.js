import Login from './pages/Login';
import './styles/App.css';
import { ToastContainer } from 'react-toast'

function App() {
  return (
    <div className="App">
      <Login />
      <ToastContainer position='bottom-center' delay={2000} />
    </div>
  );
}

export default App;
