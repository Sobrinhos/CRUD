import './styles/App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { ToastContainer } from 'react-toast'
import Router from './Router';

function App() {
  return (
    <div className="App">
      <Router />
      <ToastContainer position='bottom-center' delay={2000} />
    </div>
  );
}

export default App;
