using UnityEngine;

public class NPCInteraction : MonoBehaviour
{
    public string mensagem = "Olá, bem-vindo à vila!";
    private bool jogadorPerto = false;

    void Update()
    {
        if (jogadorPerto && Input.GetKeyDown(KeyCode.E))
        {
            // Aqui você pode chamar o sistema de diálogo
            Debug.Log(mensagem);
            // Exemplo: DialogueManager.Instance.MostrarMensagem(mensagem);
        }
    }

    void OnTriggerEnter2D(Collider2D other)
    {
        if (other.CompareTag("Player"))
        {
            jogadorPerto = true;
        }
    }

    void OnTriggerExit2D(Collider2D other)
    {
        if (other.CompareTag("Player"))
        {
            jogadorPerto = false;
        }
    }
}
