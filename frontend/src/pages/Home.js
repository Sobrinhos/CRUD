import React from "react";
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';

import "./../styles/pages/Home.css";

export default function Home() {
  return (
    <Container className="container-externo">
      <Navbar bg="light" expand="lg">
        <Container>
          <Navbar.Brand href="#home">Site do Sobrinho</Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="">
              <Nav.Link href="#home">Home</Nav.Link>
              <Nav.Link href="#link">Leads</Nav.Link>
              <NavDropdown title="Usuário" id="basic-nav-dropdown">
                <NavDropdown.Item href="#action/3.1">Novo</NavDropdown.Item>
                <NavDropdown.Item href="#action/3.2">Perfil</NavDropdown.Item>
                <NavDropdown.Item href="#action/3.3">Nivel de Acesso</NavDropdown.Item>
              </NavDropdown>
            </Nav>
          </Navbar.Collapse>
        </Container>
      </Navbar>
    </Container>
  );
}
